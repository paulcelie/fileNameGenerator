<?php

namespace FileNameGenerator\Validator;

use FileNameGenerator\Validator\Exception\ValidationException;

/**
 * Class FileNameValidator
 * @package FileNameGenerator\Validator
 */
class FileNameValidator extends NoEmptyStringValidator
{
    protected const REGEX = '/[\\\"\*<>\|:\/]/';

    /**
     * @param string $value
     * @throws ValidationException
     */
    protected function validateString(string $value)
    {
        parent::validateString($value);

        if (preg_match(self::REGEX, $value)) {
            throw new ValidationException(sprintf("Filename contains invalid characters, should not match %s", self::REGEX));
        }
    }
}