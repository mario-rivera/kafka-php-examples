<?php
namespace App\EventStreaming\Producer;

use Interop\Queue\Context;

interface MessageProducerInterface
{
    /**
     * @param Context $context
     * @return MessageProducerInterface
     */
    public function setContext(Context $context): MessageProducerInterface;

    /**
     * @param MessageDispatcherInterface $dispatcher
     * @return MessageProducerInterface
     */
    public function setDispatcher(MessageDispatcherInterface $dispatcher): MessageProducerInterface;
}
