<?php
namespace App\C_Conv\Repository;

use App\C_Conv\Model\Branch;
use Psr\Log\LoggerInterface;

class BranchsService
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findAllBranchs():array
    {
        $this->logger->info(message: 'Branchs');
        return [
            new Branch(
                id: 1,
                branch_parent_id: 0,
            ),
            new Branch(
                id: 2,
                branch_parent_id: 1,
            ),
            new Branch(
                id: 3,
                branch_parent_id: 1,
            ),
            new Branch(
                id: 4,
                branch_parent_id: 2,
            ),
            new Branch(
                id: 5,
                branch_parent_id: 2,
            ),
            new Branch(
                id: 6,
                branch_parent_id: 4,
            ),
            new Branch(
                id: 7,
                branch_parent_id: 5,
            ),
            new Branch(
                id: 8,
                branch_parent_id: 0,
            ),
            new Branch(
                id: 9,
                branch_parent_id: 8,
            ),
        ];
    }
}