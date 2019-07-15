<?php
namespace App\EventStreaming\Processor;

use Interop\Queue\Message;

use App\EventStreaming\Consumer\MessageReceiverInterface;

interface MessageProcessorInterface
{
    /**
     * @param string $destination
     * @return MessageProcessorInterface
     */
    public function setDestinationName(string $destination): MessageProcessorInterface;

    /**
     * @return string
     */
    public function getDestinationName(): string;

    /**
     * @param Message $message
     * @return bool Whether the message was processed succesfully or not
     */
    public function process(Message $message): bool;
}
