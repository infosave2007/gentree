<?php

namespace Gentree;

class Gentree
{
    private array $csvData;

    public function __construct(array $csvData)
    {
        $this->csvData = $csvData;
    }

    public function buildTree(string $parentId = ''): array
    {
        $branch = array();
        foreach ($this->csvData as $row) {
            if ($row['Parent'] === $parentId) {
                $node = new TreeNode($row);
                $children = $this->buildTree($row['Item Name']);
                foreach ($children as $child) {
                    $node->addChild($child);
                }
                $branch[] = $node;
            }
        }
        return $branch;
    }
public function extendTree(array $tree): array
    {
        foreach ($tree as &$node) {
            if ($node->getData()['Type'] === 'Прямые компоненты' && !empty($node->getData()['Relation'])) {
                $relatedItem = null;
                foreach ($this->csvData as $element) {
                    if ($element['Item Name'] == $node->getData()['Relation']) {
                        $relatedItem = $element;
                        break;
                    }
                }
                if ($relatedItem) {
                    $relatedBranch = $this->buildTree($relatedItem['Item Name']);
                    if ($relatedBranch) {
                        $node->setChildren($this->extendTree($relatedBranch));
                    }
                }
            } elseif (!empty($node->getChildren())) {
                $node->setChildren($this->extendTree($node->getChildren()));
            }
        }

        return $tree;
    }

    public function generateJsonTree(): string
    {
        $tree = $this->buildTree();
        $extendedTree = $this->extendTree($tree);
        $arrayTree = array_map(function ($node) {
            return $node->toArray();
        }, $extendedTree);
        return json_encode($arrayTree, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
