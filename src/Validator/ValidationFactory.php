<?php

namespace FileNameGenerator\Validator;

/**
 * Class ValidationFactory
 * @package FileNameGenerator\Validator
 */
class ValidationFactory
{
    /**
     * @param string $validationClass
     * @return ValidatorInterface
     */
    public static function create(string $validationClass)
    {
        if (!class_exists($validationClass)) {
            throw new \InvalidArgumentException(sprintf("Class %s does not exist", $validationClass));
        }

        $validator = new $validationClass();
        if (!$validator instanceof ValidatorInterface) {
            throw new \InvalidArgumentException(sprintf("Class %s is no valid validator, it should be an instance of %s", $validationClass, ValidatorInterface::class));
        }

        return $validator;
    }
}