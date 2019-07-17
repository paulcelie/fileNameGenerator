<?php

namespace Test;

use FileNameGenerator\Validator\Exception\ValidationException;
use FileNameGenerator\Validator\NoEmptyStringValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class NoEmptyStringValidatorTest
 * @package Test
 */
class NoEmptyStringValidatorTest extends TestCase
{
    public function testValidate()
    {
        $validator = new NoEmptyStringValidator();

        $this->expectException(ValidationException::class);
        $validator->validate('');
    }
}