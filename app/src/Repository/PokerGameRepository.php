<?php

namespace App\Repository;

use App\Entity\PokerGame;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Hoa\Exception\Exception;

class PokerGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokerGame::class);
    }

    public function save(PokerGame $pokerGame): void
    {
        if (!$pokerGame instanceof PokerGame) {
            throw new Exception(sprintf('Instances of "%s" are not supported.', \get_class($pokerGame)));
        }

        $this->_em->persist($pokerGame);
        $this->_em->flush();
    }
}
