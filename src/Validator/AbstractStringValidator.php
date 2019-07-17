<?php

namespace FileNameGenerator\Validator;

use FileNameGenerator\Validator\Exception\ValidationException;

/**
 * Class AbstractStringValidator
 * @package FileNameGenerator\Validator
 */
abstract class AbstractStringValidator implements ValidatorInterface
{
    /**
     * @param mixed $value
     * @throws ValidationException
     */
    final public function validate($value)
    {
        if (!is_string($value)) {
            throw new ValidationException(sprintf("Expected string, %s was provided", gettype($value)));
        }

        $this->validateString($value);
    }

    /**
     * @param string $value
     * @return void
     * @throws ValidationException
     */
    abstract protected function validateString(string $value);
}