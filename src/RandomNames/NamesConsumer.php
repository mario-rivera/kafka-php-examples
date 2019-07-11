<?php
namespace App\RandomNames;

use App\EventStreaming\Processor\MessageProcessorInterface;
use Interop\Queue\Message;

use App\DecoratedNames\DecoratedNamesProducer;

class NamesConsumer implements MessageProcessorInterface
{
    /**
     * @var DecoratedNamesProducer
     */
    private $decorator;

    public function __construct(
        DecoratedNamesProducer $decorator
    ){
        $this->decorator = $decorator;
    }

    /**
     * @param Message $message
     * @return bool Whether the message was processed succesfully or not
     */
    public function process(Message $message): bool
    {
        echo $message->getBody() . PHP_EOL;
        // $this->decorator->decorate($message->getBody());
        
        return true;
    }
}
