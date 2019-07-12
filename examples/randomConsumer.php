<?php
$container = require_once dirname(__DIR__, 1) . '/src/container.php';

$consumer = $container->get(\App\EventStreaming\Consumer\MessageConsumer::class);

$consumer
->setMessageProcessor($container->get(\App\RandomNames\NamesConsumer::class))
->listen();
