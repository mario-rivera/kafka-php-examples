<?php
namespace App\EventStreaming;

use Interop\Queue\Context;
use Enqueue\RdKafka\RdKafkaConnectionFactory;

class QueueContextFactory
{
    public function create($broker): Context
    {
        $connectionFactory = new RdKafkaConnectionFactory([
            'global' => [
                'group.id' => (empty(getenv('CONSUMER_GROUP_ID'))) ? getenv('CONSUMER_GROUP_ID') : uniqid('', true),
                'metadata.broker.list' => $broker,
                'enable.auto.commit' => 'true',
            ],
            'topic' => [
                'auto.offset.reset' => 'beginning',
            ],
        ]);

        return $connectionFactory->createContext();
    }
}
