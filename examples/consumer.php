<?php
$container = require_once dirname(__DIR__, 1) . '/src/container.php';

$consumerFactory = $container->get(\App\EventStreaming\Consumer\ConsumerFactory::class);
$partition = (empty(getenv('CONSUMER_PARTITION'))) ? 0 : getenv('CONSUMER_PARTITION');

$consumer = $consumerFactory->create(getenv('TEST_TOPIC'), $partition);
$consumer->setOffset(0);

$read = 0;
while(true){
    $message = $consumer->receive();
    // process a message
    echo ++$read . ' - ' . $message->getKafkaMessage()->payload . PHP_EOL;
    $consumer->acknowledge($message);
}