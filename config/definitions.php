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
    \App\EventStreaming\Consumer\MessageConsumer::class =>
        \DI\factory([\App\EventStreaming\Consumer\MessageConsumerFactory::class, 'create'])
        ->parameter('topic', getenv('CONSUMER_TOPIC')),
    \App\EventStreaming\Producer\MessageDispatcherInterface::class => 
        \DI\factory([\App\EventStreaming\Producer\MessageDispatcherFactory::class, 'create']),
    /*** Define a producer ***/
    \App\RandomNames\NamesProducer::class => \DI\autowire()
        ->constructorParameter('topic', getenv('NAMES_TOPIC')),
    /*** Define a producer ***/
    \App\DecoratedNames\DecoratedNamesProducer::class => \DI\autowire()
        ->constructorParameter('topic', getenv('DECORATED_NAMES_TOPIC')),
];
