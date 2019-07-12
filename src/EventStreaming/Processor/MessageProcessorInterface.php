<?php
namespace App\EventStreaming\Processor;

use Interop\Queue\Message;

use App\EventStreaming\Consumer\MessageReceiverInterface;

interface MessageProcessorInterface
{
    /**
     * @return MessageReceiverInterface
     */
    public function getMessageReceiver(): MessageReceiverInterface;

    /**
     * @param Message $message
     * @return bool Whether the message was processed succesfully or not
     */
    public function process(Message $message): bool;
}
