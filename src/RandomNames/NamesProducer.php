<?php
namespace App\RandomNames;

use Interop\Queue\Context;

use App\EventStreaming\Producer\MessageProducerInterface;
use App\EventStreaming\Producer\MessageDispatcherInterface;

class NamesProducer implements MessageProducerInterface
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

    public function produce()
    {
        $generator = \Nubs\RandomNameGenerator\All::create();

        for($i=0; $i<200; $i++){

            $message = $this->context->createMessage($generator->getName());
            $this->dispatcher->send($message);
        
            echo "Message {$i} sent" . PHP_EOL;
            sleep(1);
        }
    }
}
