<?php
namespace App\EventStreaming;

use Interop\Queue\Context;
use Enqueue\RdKafka\RdKafkaConnectionFactory;

class QueueContextFactory
{
    /**
     * @param mixed $conf
     */
    public function create($conf): Context
    {
        return (new RdKafkaConnectionFactory($conf))->createContext();
    }
}
