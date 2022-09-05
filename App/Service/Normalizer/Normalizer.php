<?php


namespace App\Service\Normalizer;


abstract class Normalizer
{
    abstract public function normalize(array $data) : array;
}