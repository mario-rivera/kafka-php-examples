<?php
namespace App\EventStreaming\Consumer;

use Interop\Queue\Consumer;

use App\EventStreaming\Processor\MessageProcessorInterface;

class MessageConsumer implements MessageReceiverInterface
{
    /**
     * @var Consumer
     */
    private $consumer;

    /**
     * @var MessageProcessorInterface
     */
    private $messageProcessor;

    /**
     * @param Consumer $consumer
     * @return MessageConsumer
     */
    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
        return $this;
    }

    /**
     * @param MessageProcessorInterface $messageProcessor
     * @return MessageConsumer
     */
    public function setMessageProcessor(MessageProcessorInterface $messageProcessor)
    {
        $this->messageProcessor = $messageProcessor;
        return $this;
    }

    /**
     * @return void
     */
    public function listen()
    {
        while(true){
            $message = $this->consumer->receive();
            // process a message
            $processed = $this->messageProcessor->process($message);

            ($processed) ? 
                $this->consumer->acknowledge($message) : $this->consumer->reject($message);
        }
    }
}
