#!/bin/php
<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-20 
 */

$isNotCalledFromCommandLineInterface = (PHP_SAPI !== 'cli');

if ($isNotCalledFromCommandLineInterface) {
    echo 'This script works only from cli' . PHP_EOL;
    exit(1);
}

$hasValidNumberOfArguments = ($argc === 2);
$argumentsAreValid = ($hasValidNumberOfArguments
    && (strlen(trim($argv[1])) > 0));

if (!$argumentsAreValid) {
    $usageMessage = 'No or invalid arguments supplied.' . PHP_EOL .
        'Usage: ' . basename(__FILE__) . ' <date>';

    echo $usageMessage . PHP_EOL;
    exit(1);
}

require_once __DIR__ . '/../vendor/autoload.php';

$date = $argv[1];
$dateTime = new DateTime($date);

echo 'Date: ' . $dateTime->format('Y-m-d H:i:s') . PHP_EOL;
echo 'TimeStamp: ' . $dateTime->format('U') . PHP_EOL;
