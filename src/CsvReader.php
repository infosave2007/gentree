<?php

namespace Gentree;

class CsvReader
{
    public static function read(string $filename, string $delimiter = ';', string $enclosure = '"'): array
    {
        $rows = array_map(function ($line) use ($delimiter, $enclosure) {
            return str_getcsv($line, $delimiter, $enclosure);
        }, file($filename));
        $header = array_shift($rows);
        $data = array();
        foreach ($rows as $row) {
            $data[] = array_combine($header, $row);
        }
        return $data;
    }
}
