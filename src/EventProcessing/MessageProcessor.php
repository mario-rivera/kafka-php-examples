<?php
namespace App\EventProcessing;

use App\EventStreaming\Processor\MessageProcessorInterface;
use Interop\Queue\Message;

class MessageProcessor implements MessageProcessorInterface
{
    /**
     * @param Message $message
     * @return bool Whether the message was processed succesfully or not
     */
    public function process(Message $message): bool
    {
        echo $message->getBody() . PHP_EOL;
        return true;
    }
}
