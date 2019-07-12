<?php
namespace App\RandomNames;

use Interop\Queue\Context;
use Interop\Queue\Destination;

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

    /**
     * @param Destination $destination
     * @return NamesProducer
     */
    public function setDestination(Destination $destination): MessageProducerInterface
    {
        $this->destination = $destination;
        return $this;
    }

    public function produce()
    {
        $generator = \Nubs\RandomNameGenerator\All::create();

        for($i=0; $i<200; $i++){

            $message = $this->context->createMessage($generator->getName());
            $this->dispatcher->send($this->destination, $message);
        
            echo "Message {$i} sent" . PHP_EOL;
            sleep(1);
        }
    }
}
