<?php


namespace App\Service\Normalizer;


use App\Node\Node;

class NodeNormalizer extends Normalizer
{
    /**
     * @param Node[] $data
     * @return array
     */
    public function normalize(array $data) : array
    {
        $arr = [];
        foreach ($data as $node) {
            $line['itemName'] = $node->name;
            $line['parent'] = $node->parentName;
            $line['children'] = !empty($node->children) ? $this->normalize($node->children) : [];
            $arr[] = $line;
        }
        return $arr;
    }
}