<?php

namespace FileNameGenerator\FileNameGenerator;

/**
 * Interface FileNameGeneratorInterface
 * @package FileNameGenerator\FileNameGenerator
 */
interface FileNameGeneratorInterface
{
    const EXTENSION_TXT = 'txt';
    const EXTENSION_CSV = 'csv';

    const DEFAULT_EXTENSION = self::EXTENSION_TXT;

    /**
     * @return string
     */
    public function get(): string;

    /**
     * @param string $extension
     * @return FileNameGeneratorInterface
     */
    public function setExtension(string $extension): self;
}