#!/usr/bin/env php
<?php

//$conn = ssh2_connect($_ENV['INPUT_SSH-HOST'], $_ENV['INPUT_SSH-PORT']);
//ssh2_auth_password($conn, $_ENV['INPUT_SSH-USER'], $_ENV['INPUT_SSH-PASSWORD']);

$files = new DirectoryIterator(__DIR__);

foreach ($files as $file) {
    echo $file->getFilename() . PHP_EOL;
}

echo 'Deploying...' . PHP_EOL;
