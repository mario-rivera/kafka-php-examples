<?php
namespace App\EventStreaming\Consumer;

use Interop\Queue\Consumer;
use App\EventStreaming\Processor\MessageProcessorInterface;

interface MessageReceiverInterface
{

    /**
     * @param Consumer $consumer
     * @return MessageReceiverInterface
     */
    public function setConsumer(Consumer $consumer);

    /**
     * @param MessageProcessorInterface $messageProcessor
     * @return MessageReceiverInterface
     */
    public function setMessageProcessor(MessageProcessorInterface $messageProcessor);

    /**
     * @return void
     */
    public function listen();
}
