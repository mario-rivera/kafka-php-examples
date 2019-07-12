<?php
$container = require_once dirname(__DIR__, 1) . '/src/container.php';

$processor = $container->get(\App\RandomNames\NamesConsumer::class);

$consumer = $processor->getMessageReceiver();
$consumer->setMessageProcessor($processor)->listen();