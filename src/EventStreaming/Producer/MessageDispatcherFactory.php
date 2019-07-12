<?php
namespace App\EventStreaming\Producer;

use Psr\Container\ContainerInterface;
use Interop\Queue\Context;

class MessageDispatcherFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param Context $context
     */
    public function __construct(
        ContainerInterface $container
    ){
        $this->container = $container;
    }

    public function create(): MessageDispatcherInterface
    {
        $context = $this->container->get(Context::class);

        $dispatcher = $this->container->get(MessageDispatcher::class);
        $dispatcher
        ->setProducer($context->createProducer());

        return $dispatcher;
    }
}
