<?php
namespace App\Repository;

use App\Model\Canal;
use Psr\Log\LoggerInterface;

class CanalsService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findAllCanals():array
    {
        $this->logger->info(message: 'Canals');
        return [
            new Canal (
                id: 1,
                branch_id: 1,
                name: "Canal de tests",
            ),
            new Canal (
                id: 2,
                branch_id: 1,
            ),
            new Canal (
                id: 3,
                branch_id: 2,
            ),
            new Canal (
                id: 4,
                branch_id: 2,
            ),
            new Canal (
                id: 4,
                branch_id: 8,
            ),
        ];
    }
}