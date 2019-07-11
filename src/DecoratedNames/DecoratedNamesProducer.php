<?php
namespace App\DecoratedNames;

use Interop\Queue\Context;

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
     * @param Context $context
     * @return NamesProducer
     */
    public function setContext(Context $context): MessageProducerInterface
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @param MessageDispatcherInterface $dispatcher
     * @return NamesProducer
     */
    public function setDispatcher(MessageDispatcherInterface $dispatcher): MessageProducerInterface
    {
        $this->dispatcher = $dispatcher;
        return $this;
    }

    public function decorate(string $input)
    {
        $decorated = [
            'decorated_property' => uniqid('deco', true),
            'name' => $input  
        ];

        $message = $this->context->createMessage(json_encode($decorated));
        $this->dispatcher->send($message);
    }
}
