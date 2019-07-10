<?php
namespace App\EventStreaming\Producer;

use Psr\Container\ContainerInterface;
use Interop\Queue\Context;

class TopicProducerFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Context
     */
    private $context;

    /**
     * @param Context $context
     */
    public function __construct(
        ContainerInterface $container,
        Context $context
    ){
        $this->container = $container;
        $this->context = $context;
    }

    public function create(string $topic)
    {

    }
}
