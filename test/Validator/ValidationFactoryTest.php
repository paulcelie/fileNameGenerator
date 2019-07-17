<?php

namespace Test;

use FileNameGenerator\Validator\ValidationFactory;
use FileNameGenerator\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ValidationFactoryTest
 * @package Test
 */
class ValidationFactoryTest extends TestCase
{
    public function testCreate()
    {
        $mockInterface = $this->createMock(ValidatorInterface::class);
        $class = ValidationFactory::create(get_class($mockInterface));

        $this->assertTrue($class instanceof ValidatorInterface);
    }

    /**
     * @param string $className
     * @dataProvider provider
     */
    public function testFailCreate($value)
    {
        $this->expectException(\InvalidArgumentException::class);
        ValidationFactory::create($value);
    }

    /**
     * @return array
     */
    public function provider()
    {
        return [
            [\DateTime::class],
            ['test'],
            [\Exception::class],
        ];
    }
}