<?php

namespace AKazak\FileReader;

use AKazak\FileReader\Exception\ExtensionNotSupportedException;
use AKazak\FileReader\Exception\FileNotFoundException;
use AKazak\FileReader\Reader\ReaderInterface;

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

        $reader = $this->getReaderByFileExt($ext);

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

    /**
     * @param string $ext
     * @return ReaderInterface
     *
     * @throws ExtensionNotSupportedException
     */
    protected function getReaderByFileExt(string $ext): ReaderInterface
    {
        $className = '\AKazak\FileReader\Reader\\' . ucfirst($ext) . 'Reader';
        if (!class_exists($className)) {
            throw new ExtensionNotSupportedException('Not supported extension');
        }
        return new $className();
    }
}