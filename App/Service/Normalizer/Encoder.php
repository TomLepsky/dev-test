<?php


namespace App\Service\Normalizer;


abstract class Encoder
{
    abstract public function encode(array $data) : string;

    abstract public function getExtension() : string;
}