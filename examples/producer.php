<?php
$container = require_once dirname(__DIR__, 1) . '/src/container.php';

$context = $container->get(\Interop\Queue\Context::class);
$message = $context->createMessage("Hello World");

$messenger = $container->get(\App\EventStreaming\Producer\SimpleMessenger::class);

$messenger->send($message);

echo "Message sent" . PHP_EOL;
