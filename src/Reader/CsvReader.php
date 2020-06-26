<?php

namespace AKazak\FileReader\Reader;

use AKazak\FileReader\Exception\FileNotFoundException;

class CsvReader implements ReaderInterface
{
    public function getInfo(string $filePath, array $fields): array
    {
        return $this->parseFile($filePath, $fields);
    }

    /**
     * @param string $filePath
     * @param array $fields
     * @return array
     * @throws FileNotFoundException
     */
    protected function parseFile(string $filePath, array $fields): array
    {
        $results = [];

        $handle = fopen($filePath, 'r');
        if (!$handle) {
            throw new FileNotFoundException('File not found or cannot be opened');
        }

        $columns = fgetcsv($handle);
        if (!$columns) {
            fclose($handle);
            return $results;
        }

        $fieldsPositions = $this->getFieldsPositionsInLine($columns, $fields);
        while (($line = fgetcsv($handle)) !== false) {
            $info = $this->processLine($line, $fieldsPositions);
            if (!$info) {
                continue;
            }
            $results[] = $info;
        }
        fclose($handle);

        return $results;
    }

    /**
     * @param array $lineParts
     * @param array $fieldsPositions
     * @return array
     */
    protected function processLine(array $lineParts, array $fieldsPositions): array
    {
        $info = [];
        foreach ($fieldsPositions as $name => $position) {
            if (!$lineParts[$position]) {
                continue;
            }
            $info[$name] = $lineParts[$position];
        }
        return $info;
    }

    /**
     * @param array $values
     * @param array $fields
     * @return array
     */
    protected function getFieldsPositionsInLine(array $values, array $fields): array
    {
        $fieldsPositions = [];

        foreach ($fields as $fieldName) {
            $fieldPosition = array_search($fieldName, $values);
            if ($fieldPosition === false) {
                continue;
            }
            $fieldsPositions[$fieldName] = $fieldPosition;
        }

        return $fieldsPositions;
    }
}