<?php
$container = require_once dirname(__DIR__, 1) . '/src/container.php';

$context = $container->get(\Interop\Queue\Context::class);
$generator = \Nubs\RandomNameGenerator\All::create();


for($i=0; $i<200; $i++){

    $message = $context->createMessage($generator->getName());
    $messenger = $container->get(\App\EventStreaming\Producer\SimpleMessenger::class);
    $messenger->send($message);

    echo "Message {$i} sent" . PHP_EOL;
    sleep(1);
}
