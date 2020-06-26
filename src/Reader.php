<?php

namespace AKazak\FileReader;

use AKazak\FileReader\Reader\ReaderInterface;

class Reader
{
    /**
     * @param string $filePath
     * @param array $fieldNames
     * @return array
     */
    public function getInfo(string $filePath, array $fieldNames = []) : array
    {
        $ext = $this->getFileExtension($filePath);

        $reader = $this->getReaderByFileExt($ext);

        return $reader->getInfo($filePath, $fieldNames);
    }

    /**
     * @param string $filePath
     * @return string
     */
    protected function getFileExtension(string $filePath) : string
    {
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }

    /**
     * @param string $ext
     * @return ReaderInterface
     */
    protected function getReaderByFileExt(string $ext) : ReaderInterface
    {
        $className = '\AKazak\FileReader\Reader\\' . ucfirst($ext) . 'Reader';
        return new $className();
    }
}