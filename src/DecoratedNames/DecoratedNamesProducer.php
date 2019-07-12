<?php
namespace App\DecoratedNames;

use Interop\Queue\Context;
use Interop\Queue\Destination;

use App\EventStreaming\Producer\MessageProducerInterface;
use App\EventStreaming\Producer\MessageDispatcherInterface;

class DecoratedNamesProducer implements MessageProducerInterface
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var MessageDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var Destination $destination
     */
    private $destination;

    public function __construct(
        Context $context,
        MessageDispatcherInterface $dispatcher,
        string $topic
    ){
        $this
        ->setContext($context)
        ->setDispatcher($dispatcher)
        ->setDestination($context->createTopic($topic));
    }

    /**
     * @param Context $context
     * @return DecoratedNamesProducer
     */
    public function setContext(Context $context): MessageProducerInterface
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @param MessageDispatcherInterface $dispatcher
     * @return DecoratedNamesProducer
     */
    public function setDispatcher(MessageDispatcherInterface $dispatcher): MessageProducerInterface
    {
        $this->dispatcher = $dispatcher;
        return $this;
    }

    /**
     * @param Destination $destination
     * @return DecoratedNamesProducer
     */
    public function setDestination(Destination $destination): MessageProducerInterface
    {
        $this->destination = $destination;
        return $this;
    }

    public function decorate(string $input)
    {
        $decorated = [
            'decorated_property' => uniqid('deco', true),
            'name' => $input  
        ];

        $message = $this->context->createMessage(json_encode($decorated));
        $this->dispatcher->send($this->destination, $message);
    }
}
