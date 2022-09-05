<?php

namespace App\Service\Stream;


class Stream
{
    /** @var Reader */
    private $reader;

    /** @var Writer */
    private $writer;

    public function __construct(Reader $reader, Writer $writer)
    {

        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * @return Reader
     */
    public function getReader(): Reader
    {
        return $this->reader;
    }

    /**
     * @return Writer
     */
    public function getWriter(): Writer
    {
        return $this->writer;
    }

    /**
     * @throws Exception
     */
    public function read(string $fileName) : array
    {
        return $this->reader->read($fileName);
    }

    public function write(string $data) : void
    {
        $this->writer->write($data);
    }
}