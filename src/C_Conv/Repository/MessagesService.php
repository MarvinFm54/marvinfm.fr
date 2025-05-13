<?php
namespace App\C_Conv\Repository;

use App\C_Conv\Model\Message;
use Psr\Log\LoggerInterface;

class MessagesService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findMessagesByCanalId(int $canalId): array
    {
        // Plus tard : SELECT * FROM messages WHERE canal_id = :canalId
        return [
            new Message(
                id: 1, 
                canal_id: 1, 
                user_id: 1,
                date: '13-05-2025',
                text: 'Bonjour',
                visible: true,
            ),
            new Message(
                id: 2, 
                canal_id: 1, 
                user_id: 0,
                date: '13-05-2025',
                text: 'Hey',
                visible: true,
            ),
            new Message(
                id: 2, 
                canal_id: 1, 
                user_id: 1,
                date: '13-05-2025',
                text: 'Comment ca va ?',
                visible: true,
            ),
            new Message(
                id: 2, 
                canal_id: 1, 
                user_id: 0,
                date: '13-05-2025',
                text: 'Tranquille. Quoi de beau ?',
                visible: true,
            ),
            new Message(
                id: 2, 
                canal_id: 1,
                user_id: 1, 
                date: '13-05-2025',
                text: 'Je fais des tests...',
                visible: true,
            ),
            new Message(
                id: 2, 
                canal_id: 1, 
                user_id: 0,
                date: '13-05-2025',
                text: 'J\'espères qu\'ils seront concluants !',
                visible: true,
            ),
        ];
    }
}