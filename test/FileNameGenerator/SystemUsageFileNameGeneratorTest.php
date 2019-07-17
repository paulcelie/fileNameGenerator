<?php

namespace Test\FileNameGenerator;

use FileNameGenerator\FileNameGenerator\Exception\InvalidValueException;
use FileNameGenerator\FileNameGenerator\SystemUsageFileNameGenerator;
use PHPUnit\Framework\TestCase;

/**
 * Class SystemUsageFileNameGeneratorTest
 * @package Test\FileNameGenerator
 */
class SystemUsageFileNameGeneratorTest extends TestCase
{
    /**
     * @param string $metric
     * @param string $calledMethod
     * @throws \ReflectionException
     * @dataProvider provider
     */
    public function testFileNameWithoutExtension(string $metric, string $calledMethod)
    {
        $mock = $this->getMockBuilder(SystemUsageFileNameGenerator::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getValue',
                $calledMethod,
            ])
            ->getMock();

        $mock->expects($this->once())
            ->method('getValue')
            ->willReturn($metric);

        $mock->expects($this->once())
            ->method($calledMethod)
            ->willReturn('1');

        $reflectionClass = new \ReflectionClass(SystemUsageFileNameGenerator::class);
        $method = $reflectionClass->getMethod('getFilenameWithoutExtension');
        $method->setAccessible(true);

        $this->assertEquals('1', $method->invoke($mock));
    }

    /**
     * @return array
     */
    public function provider()
    {
        return [
            [SystemUsageFileNameGenerator::METRIC_MEMORY, 'getMetricMemory'],
            [SystemUsageFileNameGenerator::METRIC_CPU, 'getMetricCpu'],
        ];
    }

    public function testInvalidMetric()
    {

        $mock = $this->getMockBuilder(SystemUsageFileNameGenerator::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getValue',
            ])
            ->getMock();

        $mock->expects($this->any())
            ->method('getValue')
            ->willReturn('fail');


        $reflectionClass = new \ReflectionClass(SystemUsageFileNameGenerator::class);
        $method = $reflectionClass->getMethod('getFilenameWithoutExtension');
        $method->setAccessible(true);

        $this->expectException(InvalidValueException::class);
        $this->assertEquals('1', $method->invoke($mock));
    }
}