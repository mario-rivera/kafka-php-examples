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
     * @param Message $message
     * @return void
     */
    public function send(Destination $destination, Message $message);
}
