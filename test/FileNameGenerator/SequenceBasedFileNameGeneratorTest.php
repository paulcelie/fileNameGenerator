<?php

namespace Test\FileNameGenerator;

use FileNameGenerator\FileNameGenerator\SequenceBasedFileNameGenerator;
use PHPUnit\Framework\TestCase;

class SequenceBasedFileNameGeneratorTest extends TestCase
{
    public function testFileNameWithoutExtension()
    {
        $mock = $this->getMockBuilder(SequenceBasedFileNameGenerator::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getValue'
            ])
            ->getMock();

        $mock->expects($this->at(0))
            ->method('getValue')
            ->willReturn(null)
        ;

        $mock->expects($this->at(1))
            ->method('getValue')
            ->willReturn(1)
        ;

        $mock->expects($this->at(2))
            ->method('getValue')
            ->willReturn(2)
        ;

        $reflectionClass = new \ReflectionClass(SequenceBasedFileNameGenerator::class);
        $method = $reflectionClass->getMethod('getFilenameWithoutExtension');
        $method->setAccessible(true);

        $this->assertEquals('1', $method->invoke($mock));
        $this->assertEquals('2', $method->invoke($mock));
        $this->assertEquals('3', $method->invoke($mock));
    }
}