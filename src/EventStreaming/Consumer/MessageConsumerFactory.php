<?php
namespace App\EventStreaming\Consumer;

use Interop\Queue\Context;
use App\EventStreaming\Processor\MessageProcessorInterface;

class MessageConsumerFactory
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
     * @return MessageConsumer
     */
    public function create(string $topic, int $partition): MessageConsumer
    {
        $topic = $this->context->createTopic($topic);
        $topic->setPartition($partition);

        $consumer = $this->context->createConsumer($topic);
        $consumer->setOffset(0);

        $instance = (new MessageConsumer)
            ->setConsumer($consumer);

        return $instance;
    }
}
