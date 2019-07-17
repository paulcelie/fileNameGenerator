<?php

namespace FileNameGenerator\FileNameGenerator;

use FileNameGenerator\FileNameGenerator\Exception\InvalidValueException;
use FileNameGenerator\Validator\NoEmptyStringValidator;

/**
 * Class SystemUsageFileNameGenerator
 * @package FileNameGenerator\FileNameGenerator
 * @method $this __construct(string $metric)
 */
class SystemUsageFileNameGenerator extends AbstractFileNameGenerator
{
    public const METRIC_CPU    = 'cpu';
    public const METRIC_MEMORY = 'memory';

    /**
     * @return string
     * @throws InvalidValueException
     */
    protected function getFilenameWithoutExtension(): string
    {
        switch ($this->getValue()) {
            case self::METRIC_CPU:
                return $this->getMetricCpu();
            case self::METRIC_MEMORY:
                return $this->getMetricMemory();
        }

        throw new InvalidValueException(sprintf("Invalid metric '%s' provided, only one of the following is allowed: %s, %s", $this->getValue(), self::METRIC_CPU, self::METRIC_MEMORY));
    }

    /**
     * @return string
     */
    protected function getMetricCpu(): string
    {
        return sprintf("%s", sys_getloadavg()[0] * 100);
    }

    /**
     * @return string
     */
    protected function getMetricMemory(): string
    {
        return sprintf("%s", memory_get_usage());
    }

    /**
     * @return string
     */
    protected function getValidationClass(): string
    {
        return NoEmptyStringValidator::class;
    }
}