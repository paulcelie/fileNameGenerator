<?php

namespace Test\FileNameGenerator;

use FileNameGenerator\FileNameGenerator\DateBasedFileNameGenerator;
use PHPUnit\Framework\TestCase;

/**
 * Class DateBasedFileNameGeneratorTest
 * @package Test\FileNameGenerator
 */
class DateBasedFileNameGeneratorTest extends TestCase
{
    /**
     * @param $format
     * @throws \ReflectionException
     * @dataProvider provider
     */
    public function testFileNameWithoutExtension($format)
    {
        $mock = $this->getMockBuilder(DateBasedFileNameGenerator::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getValue'
            ])
            ->getMock();

        $mock->expects($this->once())
            ->method('getValue')
            ->willReturn($format);

        $reflectionClass = new \ReflectionClass(DateBasedFileNameGenerator::class);
        $method = $reflectionClass->getMethod('getFilenameWithoutExtension');
        $method->setAccessible(true);

        $now = new \DateTime();
        $this->assertEquals($now->format($format), $method->invoke($mock));
    }

    /**
     * @return array
     */
    public function provider()
    {
        return [
            ['Ymd_His'],
            ['ymw'],
            ['d'],
            ['jY-p'],
        ];
    }
}