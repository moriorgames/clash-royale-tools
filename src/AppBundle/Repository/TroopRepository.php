<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TroopRepository
 * @package AppBundle\Repository
 */
class TroopRepository extends EntityRepository
{
    /**
     * @param array $deck
     *
     * @return array
     */
    public function findByDeck(array $deck = [])
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.id IN (:ids)')
            ->setParameter('ids', $deck)
            ->getQuery()
            ->getResult();
    }
}
