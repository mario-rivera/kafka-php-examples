<?php
namespace App\DecoratedNames;

use App\EventStreaming\Processor\MessageProcessorInterface;
use Interop\Queue\Message;

class DecoratedNamesConsumer implements MessageProcessorInterface
{
    /**
     * @var int
     */
    private $count = 0;

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
