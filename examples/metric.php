<?php

use FileNameGenerator\FileNameGenerator\Exception\InvalidExtensionException;
use FileNameGenerator\FileNameGenerator\Exception\InvalidValueException;
use FileNameGenerator\FileNameGenerator\SystemUsageFileNameGenerator;
use FileNameGenerator\Validator\Exception\ValidationException;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $filenameGenerator = new SystemUsageFileNameGenerator(SystemUsageFileNameGenerator::METRIC_CPU);
    echo $filenameGenerator->get();

    $filenameGenerator = new SystemUsageFileNameGenerator(SystemUsageFileNameGenerator::METRIC_MEMORY);
    echo $filenameGenerator->setExtension('csv')->get();

} catch (ValidationException $exception) {
    printf("Validation error: %s", $exception->getMessage());
} catch (InvalidExtensionException $exception) {
    printf("Exception error: %s", $exception->getMessage());
} catch (InvalidValueException $exception) {
    printf("Invalid value: %s", $exception->getMessage());
} catch (Exception $exception) {
    printf("Unexpected error: %s", $exception->getMessage());
}

