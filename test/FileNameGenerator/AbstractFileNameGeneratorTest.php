<?php

namespace Test\FileNameGenerator;

use FileNameGenerator\FileNameGenerator\AbstractFileNameGenerator;
use FileNameGenerator\FileNameGenerator\Exception\InvalidExtensionException;
use FileNameGenerator\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractFileNameGeneratorTest
 * @package Test\FileNameGenerator
 */
class AbstractFileNameGeneratorTest extends TestCase
{
    public function testConstructor()
    {
        $mock = $this->getMockBuilder(AbstractFileNameGenerator::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'validate'
            ])
            ->getMockForAbstractClass();


        $mock->expects($this->once())
            ->method('validate');

        $reflectionClass = new \ReflectionClass(AbstractFileNameGenerator::class);
        $constructor = $reflectionClass->getConstructor();
        $constructor->invoke($mock);
    }

    public function testSetExtension()
    {

        $mock = $this->getMockBuilder(AbstractFileNameGenerator::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getAllowedExtensions',
                'setExtension',
            ])
            ->getMockForAbstractClass()
        ;

        $mock->method('getAllowedExtensions')->willReturn([
            'a',
            'b',
        ]);

        $mock->expects($this->any())->method('getAllowedExtensions');

        $reflectionClass = new \ReflectionClass(AbstractFileNameGenerator::class);
        $method = $reflectionClass->getMethod('setExtension');
        $method->invoke($mock, 'a');

        $method = $reflectionClass->getMethod('getExtension');
        $method->setAccessible(true);
        $this->assertEquals('a', $method->invoke($mock));


        $reflectionClass = new \ReflectionClass(AbstractFileNameGenerator::class);
        $method = $reflectionClass->getMethod('setExtension');
        $this->expectException(InvalidExtensionException::class);
        $method->invoke($mock, 'c');
    }

    public function testGet()
    {
        $mock = $this->getMockBuilder(AbstractFileNameGenerator::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'get',
                'getFilenameWithoutExtension',
                'getExtension',
            ])
            ->getMockForAbstractClass()
        ;

        $mock->expects($this->once())
            ->method('getFilenameWithoutExtension')
            ->willReturn('test');

        $mock->expects($this->once())
            ->method('getExtension')
            ->willReturn('html');

        $reflectionClass = new \ReflectionClass(AbstractFileNameGenerator::class);
        $method = $reflectionClass->getMethod('get');
        $this->assertEquals('test.html', $method->invoke($mock));

    }
}