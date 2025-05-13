<?php
namespace App\C_Conv\Repository;

use App\C_Conv\Model\Messages;
use Psr\Log\LoggerInterface;

class MessagesService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findAllMessages():array
    {
        $this->logger->info(message: 'Messages');
        return [
        ];
    }
}