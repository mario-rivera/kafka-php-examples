<?php
$container = require_once dirname(__DIR__, 1) . '/src/container.php';

$processor = $container->get(\App\DecoratedNames\DecoratedNamesConsumer::class);

$consumer = $processor->getMessageReceiver();
$consumer->setMessageProcessor($processor)->listen();
