<?php

namespace AKazak\FileReader\Reader;

use AKazak\FileReader\Exception\ExtensionNotSupportedException;

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