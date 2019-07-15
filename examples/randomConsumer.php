<?php
$container = require_once dirname(__DIR__, 1) . '/src/container.php';

$processor = $container->get(\App\RandomNames\NamesConsumer::class);

($container->get(\App\EventStreaming\Consumer\MessageConsumerFactory::class))
    ->create($processor)
    ->listen();
