<?php

use FileNameGenerator\FileNameGenerator\Exception\InvalidExtensionException;
use FileNameGenerator\FileNameGenerator\SequenceBasedFileNameGenerator;
use FileNameGenerator\Validator\Exception\ValidationException;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $filenameGenerator = new SequenceBasedFileNameGenerator();
    echo $filenameGenerator->get();
    echo $filenameGenerator->setExtension(SequenceBasedFileNameGenerator::EXTENSION_CSV)->get();

    $filenameGenerator = new SequenceBasedFileNameGenerator(5);
    echo $filenameGenerator->get();

    $filenameGenerator->setExtension('foobar');

} catch (ValidationException $exception) {
    printf("Validation error: %s", $exception->getMessage());
} catch (InvalidExtensionException $exception) {
    printf("Exception error: %s", $exception->getMessage());
} catch (Exception $exception) {
    printf("Unexpected error: %s", $exception->getMessage());
}

