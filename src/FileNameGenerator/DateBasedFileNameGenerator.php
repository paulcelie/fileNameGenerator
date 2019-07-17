<?php

namespace FileNameGenerator\FileNameGenerator;

use FileNameGenerator\Validator\NoEmptyStringValidator;

/**
 * Class DateBasedFileNameGenerator
 * @package FileNameGenerator\FileNameGenerator
 * @method void __construct(string $format) Date format (https://www.php.net/manual/en/function.date.php)
 */
class DateBasedFileNameGenerator extends AbstractFileNameGenerator
{
    /**
     * @return string
     */
    protected function getValidationClass(): string
    {
        return NoEmptyStringValidator::class;
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function getFilenameWithoutExtension(): string
    {
        $now = new \DateTime();
        return $now->format($this->getValue());
    }
}