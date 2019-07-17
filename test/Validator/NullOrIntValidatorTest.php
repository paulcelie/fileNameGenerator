<?php

namespace Test;

use FileNameGenerator\Validator\Exception\ValidationException;
use FileNameGenerator\Validator\NullOrIntValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class NullOrIntValidatorTest
 * @package Test
 */
class NullOrIntValidatorTest extends TestCase
{
    /**
     * @param $value
     * @throws ValidationException
     * @dataProvider provider
     */
    public function testValidate($value)
    {
        $validator = new NullOrIntValidator();
        $this->expectException(ValidationException::class);
        $validator->validate($value);
    }

    /**
     * @return array
     */
    public function provider()
    {
        return [
            ['null'],
            ['1'],
            [''],
            ['a'],
        ];
    }
}