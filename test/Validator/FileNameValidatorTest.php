<?php

namespace Test;

use FileNameGenerator\Validator\Exception\ValidationException;
use FileNameGenerator\Validator\FileNameValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class FileNameValidatorTest
 * @package Test
 */
class FileNameValidatorTest extends TestCase
{
    /**
     * @param $value
     * @throws ValidationException
     * @dataProvider provider
     */
    public function testValidate($value)
    {
        $validator = new FileNameValidator();

        $this->expectException(ValidationException::class);
        $validator->validate($value);
    }

    /**
     * @return array
     */
    public function provider()
    {
        return [
            [''],
            ['file\\'],
            ['/'],
            ['"'],
            ['file*'],
            ['|'],
            [':']
        ];
    }
}