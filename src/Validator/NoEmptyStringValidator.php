<?php

namespace FileNameGenerator\Validator;

use FileNameGenerator\Validator\Exception\ValidationException;

/**
 * Class NoEmptyStringValidator
 * @package FileNameGenerator\Validator
 */
class NoEmptyStringValidator extends AbstractStringValidator
{
    /**
     * @param string $value
     * @throws ValidationException
     */
    protected function validateString(string $value)
    {
        if (empty($value)) {
            throw new ValidationException("String cannot be empty");
        }
    }
}