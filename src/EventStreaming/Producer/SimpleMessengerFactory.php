<?php
namespace App\EventStreaming\Producer;

use Interop\Queue\Context;

class SimpleMessengerFactory
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ){
        $this->context = $context;
    }

    /**
     * @param string $topic
     * @return SimpleMessenger
     */
    public function create(string $topic): SimpleMessenger
    {
        $messenger = (new SimpleMessenger())
        ->setProducer($this->context->createProducer())
        ->setDestination($this->context->createTopic($topic));

        return $messenger;
    }
}
