<?php


namespace App\Service\Stream;


abstract class Writer
{
    /** @var string */
    protected $path;

    abstract public function write(string $data);

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }


}