<?php
namespace App\DecoratedNames;

use Interop\Queue\Message;

use App\EventStreaming\Processor\MessageProcessorInterface;
use App\EventStreaming\Consumer\MessageReceiverInterface;

class DecoratedNamesConsumer implements MessageProcessorInterface
{
    /**
     * @var MessageReceiverInterface
     */
    private $receiver;

    /**
     * @var int
     */
    private $count = 0;

    public function __construct(
        MessageReceiverInterface $receiver
    ){
        $this->receiver = $receiver;
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
        return true;
    }
}
