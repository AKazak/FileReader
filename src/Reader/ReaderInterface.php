<?php

namespace AKazak\FileReader\Reader;

use AKazak\FileReader\Exception\FileNotFoundException;

interface ReaderInterface
{
    /**
     * Get fields values from file
     *
     * @param string $filePath
     * @param array $fields
     * @return array
     *
     * @throws FileNotFoundException
     */
    public function getInfo(string $filePath, array $fields): array;
}