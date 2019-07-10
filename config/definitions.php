<?php
use Psr\Container\ContainerInterface;

return [
    \Interop\Queue\Context::class => 
        \DI\factory([\App\EventStreaming\QueueContextFactory::class, 'create'])
        ->parameter('broker', getenv('KAFKA_CONNECT')),
    \App\EventStreaming\Producer\SimpleMessenger::class =>
        \DI\factory([\App\EventStreaming\Producer\SimpleMessengerFactory::class, 'create'])
        ->parameter('topic', getenv('TEST_TOPIC')),
    \App\EventStreaming\Consumer\MessageConsumer::class =>
        \DI\factory([\App\EventStreaming\Consumer\MessageConsumerFactory::class, 'create'])
        ->parameter('topic', getenv('TEST_TOPIC'))
        ->parameter('partition', (empty(getenv('CONSUMER_PARTITION'))) ? 0 : getenv('CONSUMER_PARTITION')),
    \App\EventStreaming\Processor\MessageProcessorInterface::class =>
        \DI\autowire(\App\EventProcessing\MessageProcessor::class)
];
