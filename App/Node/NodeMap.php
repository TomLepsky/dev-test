<?php


namespace App\Node;


class NodeMap
{
    /** @var array<string, Node> */
    private $map = [];

    public function put(string $key, Node $node, bool $override = true) : bool
    {
        if ($override) {
            $this->map[$key] = $node;
        } else {
            if (!array_key_exists($key, $this->map)) {
                $this->map[$key] = $node;
            } else {
                return false;
            }
        }
        return true;
    }

    public function get(string $key) : ?Node
    {
        return array_key_exists($key, $this->map) ? $this->map[$key] : null;
    }

    public function asArray() : array
    {
        return $this->map;
    }
}