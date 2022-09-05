<?php


namespace App\Node;


class StraightComponent extends DelayedNode
{
    public function delayInit(): void
    {
        if ($this->relation === null) {
            return;
        }

        $relationChildren = [];
        foreach ($this->relation->children as &$child) {
            $clonedChild = clone $child;
            $clonedChild->parentName = $this->name;
            $relationChildren[] = $clonedChild;
        }
        $this->children = array_merge($this->children, $relationChildren);
    }
}