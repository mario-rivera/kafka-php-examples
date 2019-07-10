<?php
namespace App\EventStreaming\Producer;

use Interop\Queue\Context;
use Interop\Queue\Destination;
use Interop\Queue\Producer;

class TopicProducer implements MessageProducerInterface
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @param Context $context
     * @return TopicProducer
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @param Destination $destination
     * @return TopicProducer
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param Producer $producer
     * @return TopicProducer
     */
    public function setProducer(Producer $producer)
    {
        $this->producer = $producer;
        return $this;
    }

    /**
     * @param string $message
     * @return void
     */
    public function send(string $message)
    {
        $message = $this->context->createMessage($message);
        $this->producer->send($this->destination, $message);
    }
}
