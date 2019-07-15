<?php
use Psr\Container\ContainerInterface;

return [
    'context.conf' => [
        'global' => [
            'group.id' => (empty(getenv('CONSUMER_GROUP'))) ? uniqid('', true) : getenv('CONSUMER_GROUP'),
            'metadata.broker.list' => getenv('KAFKA_CONNECT'),
            'enable.auto.commit' => 'true',
        ],
        'topic' => [
            'auto.offset.reset' => 'smallest',
        ],
    ],
    \Interop\Queue\Context::class => 
        \DI\factory([\App\EventStreaming\QueueContextFactory::class, 'create'])
        ->parameter('conf', \DI\get('context.conf')),
    \App\EventStreaming\Producer\MessageDispatcherInterface::class => 
        \DI\factory([\App\EventStreaming\Producer\MessageDispatcherFactory::class, 'create']),
    /*** Define a producer ***/
    \App\RandomNames\NamesProducer::class => \DI\autowire()
        ->constructorParameter('topic', getenv('NAMES_TOPIC')),
    /*** Define a producer ***/
    \App\DecoratedNames\DecoratedNamesProducer::class => \DI\autowire()
        ->constructorParameter('topic', getenv('DECORATED_NAMES_TOPIC')),
    /*** Define a consumer ***/
    \App\RandomNames\NamesConsumer::class => \DI\autowire()
        ->method('setDestinationName', getenv('NAMES_TOPIC')),
    /*** Define a consumer ***/
    \App\DecoratedNames\DecoratedNamesConsumer::class => \DI\autowire()
        ->method('setDestinationName', getenv('DECORATED_NAMES_TOPIC')),
];
