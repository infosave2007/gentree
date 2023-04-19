<?php

use Gentree\CsvReader;
use Gentree\Gentree;
use PHPUnit\Framework\TestCase;

class GentreeTest extends TestCase
{
    public function testGenerateJsonTree()
    {
        $csvData = CsvReader::read(__DIR__ . '/input.csv');
        $gentree = new Gentree($csvData);
        $jsonTree = $gentree->generateJsonTree();
        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/output.json', $jsonTree);
    }
}
