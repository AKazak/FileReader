<?php

namespace AKazak\FileReader\ReaderFactory;

use AKazak\FileReader\Exception\ExtensionNotSupportedException;
use AKazak\FileReader\Reader\ReaderInterface;

final class ReaderFactory
{
    /**
     * @param string $ext
     * @return ReaderInterface
     *
     * @throws ExtensionNotSupportedException
     */
    public static function factory(string $ext): ReaderInterface
    {
        $className = '\AKazak\FileReader\Reader\\' . ucfirst($ext) . 'Reader';
        if (!class_exists($className)) {
            throw new ExtensionNotSupportedException('Not supported extension');
        }
        return new $className();
    }
}