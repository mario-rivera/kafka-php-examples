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
     * @var Destination
     */
    private $destination;

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
     * @return MessageDispatcher
     */
    public function setDestination(Destination $destination): MessageDispatcherInterface
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param Message $message
     * @return void
     */
    public function send(Message $message)
    {
        $this->producer->send($this->destination, $message);
    }
}
