<?php

namespace Gentree;

class TreeNode
{
    private array $data;
    private array $children = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function addChild(TreeNode $child): void
    {
        $this->children[] = $child;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function toArray(): array
    {
        $result = $this->data;
        if (!empty($this->children)) {
            $result['Children'] = array_map(function ($child) {
                return $child->toArray();
            }, $this->children);
        }
        return $result;
    }
}
