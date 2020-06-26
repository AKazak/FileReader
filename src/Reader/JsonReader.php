<?php

namespace AKazak\FileReader\Reader;

use AKazak\FileReader\Exception\FileNotFoundException;

class JsonReader implements ReaderInterface
{
    public function getInfo(string $filePath, array $fields): array
    {
        return $this->parseFile($filePath, $fields);
    }

    /**
     * @param string $filePath
     * @param array $fields
     * @return array
     *
     * @throws FileNotFoundException
     */
    protected function parseFile(string $filePath, array $fields): array
    {
        $result = [];
        $fileContent = file_get_contents($filePath);
        if ($fileContent === false) {
            throw new FileNotFoundException();
        }
        $fileInfo = json_decode($fileContent, true);
        foreach ($fileInfo as $entity) {
            $entityResult = $this->processEntity($entity, $fields);
            if (!$entityResult) {
                continue;
            }
            $result[] = $entityResult;
        }

        return $result;
    }

    /**
     * @param array $entity
     * @param array $fields
     * @return array
     */
    protected function processEntity(array $entity, array $fields): array
    {
        $result = [];
        foreach ($fields as $field) {
            if (!$entity[$field]) {
                continue;
            }
            $result[$field] = $entity[$field];
        }
        return $result;
    }
}