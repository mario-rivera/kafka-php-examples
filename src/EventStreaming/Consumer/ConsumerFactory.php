<?php
namespace App\EventStreaming\Consumer;

use Interop\Queue\Context;
use Interop\Queue\Consumer;

class ConsumerFactory
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ){
        $this->context = $context;
    }

    /**
     * @param string $topic
     * @param int $partition
     * @return SimpleMessenger
     */
    public function create(string $topic, int $partition): Consumer
    {
        $topic = $this->context->createTopic($topic);
        $topic->setPartition($partition);

        $consumer = $this->context->createConsumer($topic);

        return $consumer;
    }
}
