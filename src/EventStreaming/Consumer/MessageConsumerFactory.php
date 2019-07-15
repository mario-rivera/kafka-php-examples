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
    public function create(MessageProcessorInterface $processor): MessageConsumer
    {
        $topic = $this->context->createTopic($processor->getDestinationName());
        $consumer = $this->context->createConsumer($topic);

        $instance = (new MessageConsumer)
            ->setConsumer($consumer)
            ->setMessageProcessor($processor);

        return $instance;
    }
}
