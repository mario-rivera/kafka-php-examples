<?php
namespace App\DecoratedNames;

use App\EventStreaming\Processor\MessageProcessorInterface;
use Interop\Queue\Message;

class DecoratedNamesConsumer implements MessageProcessorInterface
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
