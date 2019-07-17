<?php

namespace FileNameGenerator\Validator;

use FileNameGenerator\Validator\Exception\ValidationException;

/**
 * Interface ValidatorInterface
 * @package FileNameGenerator\Validator
 */
interface ValidatorInterface
{
    /**
     * @param mixed $value
     * @return void
     * @throws ValidationException
     */
    public function validate($value);
}