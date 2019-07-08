<?php
namespace App\EventStreaming\Producer;

use Interop\Queue\Destination;
use Interop\Queue\Producer;
use Interop\Queue\Message;

class SimpleMessenger
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
     * @param Destination $destination
     * @return SimpleMessenger
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param Producer $producer
     * @return SimpleMessenger
     */
    public function setProducer(Producer $producer)
    {
        $this->producer = $producer;
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
