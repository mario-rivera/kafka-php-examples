<?php
namespace App\DecoratedNames;

use Interop\Queue\Message;
use App\EventStreaming\Processor\MessageProcessorInterface;

class DecoratedNamesConsumer implements MessageProcessorInterface
{
    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var string
     */
    private $topicName;

    /**
     * @param string $destination
     * @return DecoratedNamesConsumer
     */
    public function setDestinationName(string $destination): MessageProcessorInterface
    {
        $this->topicName = $destination;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationName(): string
    {
        return $this->topicName;
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
