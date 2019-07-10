<?php
namespace App\EventStreaming\Producer;

use Interop\Queue\Context;
use Interop\Queue\Destination;
use Interop\Queue\Producer;

interface MessageProducerInterface
{

    /**
     * @param Context $context
     * @return MessageProducerInterface
     */
    public function setContext(Context $context);

    /**
     * @param Destination $destination
     * @return MessageProducerInterface
     */
    public function setDestination(Destination $destination);

    /**
     * @param Producer $producer
     * @return MessageProducerInterface
     */
    public function setProducer(Producer $producer);

    /**
     * @param string $message
     * @return void
     */
    public function send(string $message);
}
