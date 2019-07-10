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
     * @var MessageProcessorInterface
     */
    private $messageProcessor;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
        MessageProcessorInterface $messageProcessor
    ){
        $this->context = $context;
        $this->messageProcessor = $messageProcessor;
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
            ->setConsumer($consumer)
            ->setMessageProcessor($this->messageProcessor);

        return $instance;
    }
}
