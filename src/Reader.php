<?php

namespace AKazak\FileReader;

use AKazak\FileReader\Exception\ExtensionNotSupportedException;
use AKazak\FileReader\Exception\FileNotFoundException;
use AKazak\FileReader\ReaderFactory\ReaderFactory;

class Reader
{
    /**
     * @param string $filePath
     * @param array $fieldNames
     * @return array
     *
     * @throws FileNotFoundException
     * @throws ExtensionNotSupportedException
     */
    public function getInfo(string $filePath, array $fieldNames = []): array
    {
        if (!$fieldNames) {
            return [];
        }

        $ext = $this->getFileExtension($filePath);

        $reader = ReaderFactory::factory($ext);

        return $reader->getInfo($filePath, $fieldNames);
    }

    /**
     * @param string $filePath
     * @return string
     */
    protected function getFileExtension(string $filePath): string
    {
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }
}