<?php


namespace App\Service\Stream;



class FileWriter extends Writer
{
    public function write(string $data) : void
    {
        file_put_contents($this->path, $data);
    }
}