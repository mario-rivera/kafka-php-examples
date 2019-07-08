<?php
use Psr\Container\ContainerInterface;

return [
    \Interop\Queue\Context::class => 
        DI\factory([\App\EventStreaming\QueueContextFactory::class, 'create'])
        ->parameter('broker', getenv('KAFKA_CONNECT')),
    \App\EventStreaming\Producer\SimpleMessenger::class =>
        DI\factory([\App\EventStreaming\Producer\SimpleMessengerFactory::class, 'create'])
        ->parameter('topic', getenv('TEST_TOPIC')),
];
