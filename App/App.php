<?php


namespace App;


use App\Node\NodeFactory;
use App\Node\NodeTransformer;
use App\Service\Normalizer\JsonEncoder;
use App\Service\Normalizer\NodeNormalizer;
use App\Service\Normalizer\Serializer;
use App\Service\Stream\CsvReader;
use App\Service\Stream\FileWriter;
use App\Service\Stream\Stream;
use App\Service\Terminal;
use App\Service\TerminalException;
use Exception;

class App
{
    public static function run(array $args) : void
    {
        $terminal = new Terminal($args);
        try {
            $terminal->start();
            $stream = new Stream(new CsvReader(), new FileWriter());
            $csv = $stream->read($terminal->getInput());

            $nodeMap = NodeFactory::create($csv);
            $nodeTransformer = new NodeTransformer($nodeMap);
            $nodeTree = $nodeTransformer->buildParentChildTree()->initDelayedNodes()->getNodeTree();

            $serializer = new Serializer(new NodeNormalizer(), new JsonEncoder());
            $serializedNodes = $serializer->serialize($nodeTree);

            $path = $terminal->getOutput() . '.' . $serializer->getExtension();
            $stream->getWriter()->setPath($path);
            $stream->write($serializedNodes);
        } catch (TerminalException | Exception $e) {
            $terminal->display($e->getMessage())->terminate();
        }
    }
}