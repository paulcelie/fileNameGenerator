<?php

namespace FileNameGenerator\FileNameGenerator;

use FileNameGenerator\Validator\NullOrIntValidator;

/**
 * Class SequenceBasedFileNameGenerator
 * @package FileNameGenerator\FileNameGenerator
 * @method $this __construct(int $sequence = null)
 */
class SequenceBasedFileNameGenerator extends AbstractFileNameGenerator
{
    protected const SEQUENCE_START = 1;

    /**
     * @return string
     */
    protected function getFilenameWithoutExtension(): string
    {
        if ($this->getValue() === null) {
            $this->value = 1;
        }

        return sprintf("%s", $this->value++);
    }

    /**
     * @return string
     */
    protected function getValidationClass(): string
    {
        return NullOrIntValidator::class;
    }
}