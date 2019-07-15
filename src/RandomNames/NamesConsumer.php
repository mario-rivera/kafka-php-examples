<?php
namespace App\RandomNames;

use Interop\Queue\Message;

use App\EventStreaming\Processor\MessageProcessorInterface;
use App\DecoratedNames\DecoratedNamesProducer;

class NamesConsumer implements MessageProcessorInterface
{
    /**
     * @var string
     */
    private $topicName;

    /**
     * @var DecoratedNamesProducer
     */
    private $decorator;

    /**
     * @var int
     */
    private $count = 0;

    public function __construct(
        DecoratedNamesProducer $decorator
    ){
        $this->decorator = $decorator;
    }

    /**
     * @param string $destination
     * @return NamesConsumer
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
        $this->decorator->decorate($message->getBody());
        
        return true;
    }
}
