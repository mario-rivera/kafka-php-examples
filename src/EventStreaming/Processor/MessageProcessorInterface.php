<?php
namespace App\EventStreaming\Processor;

use Interop\Queue\Message;

interface MessageProcessorInterface
{
    /**
     * @param Message $message
     * @return bool Whether the message was processed succesfully or not
     */
    public function process(Message $message): bool;
}
