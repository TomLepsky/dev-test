<?php


namespace App\Node;


class ProductAndComponent extends Node
{
    public function __construct(string $name, ?string $parentName = null)
    {
        parent::__construct($name, $parentName);
    }
}