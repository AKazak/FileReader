<?php

namespace AKazak\FileReader\Reader;

interface ReaderInterface
{
    public function getInfo(string $filePath, array $fields = []) : array;
}