<?php
namespace App\RandomNames;

use Interop\Queue\Message;

use App\EventStreaming\Processor\MessageProcessorInterface;
use App\EventStreaming\Consumer\MessageReceiverInterface;

use App\DecoratedNames\DecoratedNamesProducer;

class NamesConsumer implements MessageProcessorInterface
{
    /**
     * @var MessageReceiverInterface
     */
    private $receiver;

    /**
     * @var DecoratedNamesProducer
     */
    private $decorator;

    /**
     * @var int
     */
    private $count = 0;

    public function __construct(
        MessageReceiverInterface $receiver,
        DecoratedNamesProducer $decorator
    ){
        $this->receiver = $receiver;
        $this->decorator = $decorator;
    }

    /**
     * @return MessageReceiverInterface
     */
    public function getMessageReceiver(): MessageReceiverInterface
    {
        return $this->receiver;
    }

    /**
     * @param Message $message
     * @return bool Whether the message was processed succesfully or not
     */
    public function process(Message $message): bool
    {
        echo ++$this->count . '-' . $message->getBody() . PHP_EOL;
        $this->decorator->decorate($message->getBody());
        
        return true;
    }
}
