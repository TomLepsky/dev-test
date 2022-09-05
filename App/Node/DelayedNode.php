<?php


namespace App\Node;


abstract class DelayedNode extends Node
{
    /** @var Node */
    public $relation;

    /** @var string */
    public $relationName;

    public function __construct(string $name, ?string $parentName = null, ?string $relationName = null)
    {
        parent::__construct($name, $parentName);
        $this->relationName = $relationName;
    }

    abstract public function delayInit() : void;
}