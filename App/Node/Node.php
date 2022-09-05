<?php


namespace App\Node;


abstract class Node
{
    /** @var string */
    public $name;

    /** @var Node|null */
    public $parent = null;

    /** @var Node[] */
    public $children = [];

    /** @var string */
    public $parentName;

    /**
     * Node constructor.
     * @param string $name
     * @param string|null $parentName
     */
    public function __construct(string $name, ?string $parentName = null)
    {
        $this->name = $name;
        $this->parentName = $parentName;
    }
}