<?php
namespace App\EventStreaming\Producer;

use Interop\Queue\Destination;
use Interop\Queue\Producer;
use Interop\Queue\Message;

interface MessageDispatcherInterface
{
    /**
     * @param Producer $producer
     * @return MessageDispatcherInterface
     */
    public function setProducer(Producer $producer): MessageDispatcherInterface;

    /**
     * @param Destination $destination
     * @return MessageDispatcherInterface
     */
    public function setDestination(Destination $destination): MessageDispatcherInterface;

    /**
     * @param Message $message
     * @return void
     */
    public function send(Message $message);
}
