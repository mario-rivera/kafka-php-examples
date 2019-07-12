<?php
namespace App\EventStreaming\Producer;

use Interop\Queue\Context;
use Interop\Queue\Destination;

interface MessageProducerInterface
{
    /**
     * @param Context $context
     * @return MessageProducerInterface
     */
    public function setContext(Context $context): MessageProducerInterface;

    /**
     * @param Destination $destination
     * @return MessageProducerInterface
     */
    public function setDestination(Destination $destination): MessageProducerInterface;

    /**
     * @param MessageDispatcherInterface $dispatcher
     * @return MessageProducerInterface
     */
    public function setDispatcher(MessageDispatcherInterface $dispatcher): MessageProducerInterface;
}
