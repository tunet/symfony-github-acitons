#!/usr/bin/env php
<?php

echo 'Test deploy PHP-script' . PHP_EOL;

var_dump($_ENV);

$files = new DirectoryIterator(__DIR__ . '/github/workspace');

foreach ($files as $file) {
    echo $file->getFilename() . PHP_EOL;
}
