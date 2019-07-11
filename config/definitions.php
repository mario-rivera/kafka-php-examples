<?php
use Psr\Container\ContainerInterface;

return [
    \Interop\Queue\Context::class => 
        \DI\factory([\App\EventStreaming\QueueContextFactory::class, 'create'])
        ->parameter('broker', getenv('KAFKA_CONNECT')),
    \App\EventStreaming\Consumer\MessageConsumer::class =>
        \DI\factory([\App\EventStreaming\Consumer\MessageConsumerFactory::class, 'create'])
        ->parameter('topic', getenv('CONSUMER_TOPIC'))
        ->parameter('partition', (empty(getenv('CONSUMER_PARTITION'))) ? 0 : getenv('CONSUMER_PARTITION')),
    /*** Define a producer ***/
    \App\RandomNames\NamesProducer::class => 
        \DI\factory([\App\EventStreaming\Producer\TopicProducerFactory::class, 'create'])
        ->parameter('class', \App\RandomNames\NamesProducer::class)
        ->parameter('topic', getenv('NAMES_TOPIC')),
    /*** Define a producer ***/
    \App\DecoratedNames\DecoratedNamesProducer::class => 
        \DI\factory([\App\EventStreaming\Producer\TopicProducerFactory::class, 'create'])
        ->parameter('class', \App\DecoratedNames\DecoratedNamesProducer::class)
        ->parameter('topic', getenv('DECORATED_NAMES_TOPIC')),
];
