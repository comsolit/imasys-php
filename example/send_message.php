<?php

require '../vendor/autoload.php';

use Comsolit\ImasysPhp\PortalServers;
use Comsolit\ImasysPhp\Credentials;
use Comsolit\ImasysPhp\Connection;
use Comsolit\ImasysPhp\ApiMethods\SendMessageRequest;
use Comsolit\ImasysPhp\ApiMethods\BatchStatusRequest;

$config = require __DIR__ . '/config.php';

if (count($argv) !== 4) {
    die('usage: send_message.php MESSAGE ADDRESS ORIGINATOR');
}

$credentials = new Credentials($config['user'], $config['password']);

$portalServers = PortalServers::fetchPortalServers($config['host'], $credentials);

$connection = new Connection($credentials, $portalServers);

$sendMessageRequest = new SendMessageRequest($argv[1], $argv[2], $argv[3]);

$sendMessageResponse = $connection->send($sendMessageRequest);

$batchStatusRequest = new BatchStatusRequest($sendMessageResponse->getBatchId());
$batchStatusResponse = $connection->send($batchStatusRequest);

foreach ($batchStatusResponse->getBatch()->getMessages() as $message) {
    print_r($message->getStatus());
}
