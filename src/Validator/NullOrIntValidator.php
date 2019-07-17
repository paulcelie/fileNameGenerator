<?php

namespace FileNameGenerator\Validator;

use FileNameGenerator\Validator\Exception\ValidationException;

/**
 * Class NullOrIntValidator
 * @package FileNameGenerator\Validator
 */
class NullOrIntValidator implements ValidatorInterface
{
    /**
     * @param mixed $value
     * @throws ValidationException
     */
    public function validate($value)
    {
        if (!is_null($value) && !is_int($value)) {
            throw new ValidationException(sprintf("Only NULL and integer values are allowed"));
        }
    }
}