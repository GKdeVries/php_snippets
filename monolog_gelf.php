<?php

/*

Snippet written and tested with the following packages :
  - "monolog/monolog": "^3.2",
  - "graylog2/gelf-php": "1.7.*",

On the moment I've written this, it doesn't use the following usefull available parameters (we have a lot of little projects).
 - App
 - Environment
Could be me since, I'm a new monolog user and could be missing something.
*/


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\GelfHandler;
use Gelf\Publisher;
use Gelf\Message;
use Gelf\Transport\UdpTransport;

$message = 'Hi there';

$transport = new UdpTransport('127.0.0.1', 12201);
$publisher = new Publisher($transport);
$gelfHandler = new GelfHandler($publisher);

$log = new Logger('name');
$log->pushHandler($gelfHandler);
$log->Warning('Warning: ' . $message);
$log->Error('Error: ' . $message);
$log->Info('Info: ' . $message);
$log->Debug('Debug: ' . $message);
