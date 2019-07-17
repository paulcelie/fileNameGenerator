<?php

use FileNameGenerator\FileNameGenerator\DateBasedFileNameGenerator;
use FileNameGenerator\FileNameGenerator\Exception\InvalidExtensionException;
use FileNameGenerator\Validator\Exception\ValidationException;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $filenameGenerator = new DateBasedFileNameGenerator('Ymd_His');
    echo $filenameGenerator->get();

    echo $filenameGenerator->setExtension('csv')->get();

} catch (ValidationException $exception) {
    printf("Validation error: %s", $exception->getMessage());
} catch (InvalidExtensionException $exception) {
    printf("Exception error: %s", $exception->getMessage());
} catch (Exception $exception) {
    printf("Unexpected error: %s", $exception->getMessage());
}

