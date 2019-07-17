<?php

namespace FileNameGenerator\FileNameGenerator;

use FileNameGenerator\FileNameGenerator\Exception\InvalidExtensionException;
use FileNameGenerator\Validator\FileNameValidator;
use FileNameGenerator\Validator\ValidationFactory;

/**
 * Class AbstractFileNameGenerator
 * @package FileNameGenerator\FileNameGenerator
 * @inheritdoc In addition
 */
abstract class AbstractFileNameGenerator implements FileNameGeneratorInterface
{
    /**
     * @var string
     */
    private $extension = self::DEFAULT_EXTENSION;

    /**
     * @var string
     */
    protected $value;

    /**
     * DateBasedFileNameGenerator constructor.
     * @param string|int|null $value
     * @throws \FileNameGenerator\Validator\Exception\ValidationException
     */
    public function __construct($value = null)
    {
        $this->value = $value;
        $this->validate();
    }

    /**
     * @param string $extension
     * @return FileNameGeneratorInterface
     * @throws InvalidExtensionException
     */
    public function setExtension(string $extension): FileNameGeneratorInterface
    {
        if (!in_array($extension, $this->getAllowedExtensions())) {
            throw new InvalidExtensionException(sprintf("Invalid extension '%s', only one of the following is allowed: %s", $extension, implode(", ", $this->getAllowedExtensions())));
        }

        $this->extension = $extension;

        return $this;
    }

    /**
     * @return array
     */
    protected function getAllowedExtensions(): array
    {
        return [
            self::EXTENSION_TXT,
            self::EXTENSION_CSV,
        ];
    }

    /**
     * @throws \FileNameGenerator\Validator\Exception\ValidationException
     */
    protected function validate()
    {
        ValidationFactory::create($this->getValidationClass())->validate($this->value);
    }

    /**
     * @return string
     * @throws \FileNameGenerator\Validator\Exception\ValidationException
     */
    public function get(): string
    {
        $filename = sprintf("%s.%s", $this->getFilenameWithoutExtension(), $this->getExtension());
        ValidationFactory::create(FileNameValidator::class)->validate($filename);

        return $filename;
    }

    /**
     * @return string
     */
    protected function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return int|string|null
     */
    protected function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    abstract protected function getValidationClass(): string;

    /**
     * @return string
     */
    abstract protected function getFilenameWithoutExtension(): string;
}