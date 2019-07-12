<?php
namespace App\EventStreaming\Producer;

use Interop\Queue\Destination;
use Interop\Queue\Producer;
use Interop\Queue\Message;

class MessageDispatcher implements MessageDispatcherInterface
{
    /**
     * @var Producer
     */
    private $producer;

    /**
     * @param Producer $producer
     * @return MessageDispatcher
     */
    public function setProducer(Producer $producer): MessageDispatcherInterface
    {
        $this->producer = $producer;
        return $this;
    }

    /**
     * @param Destination $destination
     * @param Message $message
     * @return void
     */
    public function send(Destination $destination, Message $message)
    {
        $this->producer->send($destination, $message);
    }
}
