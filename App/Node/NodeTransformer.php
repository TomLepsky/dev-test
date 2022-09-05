<?php


namespace App\Node;


class NodeTransformer
{
    /** @var ?NodeMap */
    private $nodeMap = null;

    /** @var Node[]  */
    private $tree = [];

    /** @var DelayedNode[] */
    private $delayedNodes = [];

    public function __construct(NodeMap $nodeMap)
    {
        $this->nodeMap = $nodeMap;
    }

    public function buildParentChildTree() : self
    {
        /** @var Node[] $tree */
        $this->tree = [];
        foreach ($this->nodeMap->asArray() as &$node) {
            if ($node->parentName !== null) {
                $node->parent = $this->nodeMap->get($node->parentName);
                $this->nodeMap->get($node->parentName)->children[] = $node;
            } else {
                $this->tree[] = $node;
            }

            if ($node instanceof DelayedNode) {
                $node->relation = $this->nodeMap->get($node->relationName);
                $this->delayedNodes[] = $node;
            }
        }

        return $this;
    }

    public function initDelayedNodes() : self
    {
        if (!empty($this->delayedNodes)) {
            foreach ($this->delayedNodes as &$node) {
                $node->delayInit();
            }
        }

        return $this;
    }

    /**
     * @return Node[]
     */
    public function getNodeTree(): array
    {
        return $this->tree;
    }
}