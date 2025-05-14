<?php
namespace App\C_Conv\Repository;

use App\C_Conv\Model\User;
use Psr\Log\LoggerInterface;

class UserService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findUserById(int $user_id): array
    {
        return [
            new User(
                id: 0,
                username: "identifiant",
                pseudo: "Pseudo",
            ),
        ];
    }

    public function findUsersIdsByCanal(int $canal_id): array
    {
        return [
            
        ];
    }
}