<?php


namespace App\Service\Stream;


use Exception;

abstract class Reader
{
    /**
     * @param string $fileName
     * @return array<array<string>>
     * @throws Exception
     */
    abstract public function read(string $fileName) : array;
}