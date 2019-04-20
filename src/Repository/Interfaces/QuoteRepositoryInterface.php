<?php

namespace App\Repository\Interfaces;

use App\Entity\Quote;

/**
 * Interface QuoteRepositoryInterface
 * @package App\Repository\Interfaces
 */
interface QuoteRepositoryInterface
{
    /**
     * @param int $
     * @return Quote|null
     */
    public function findById(int $id): ?Quote;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Quote $quote
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Quote $quote): void;

    /**
     * @param Quote $quote
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Quote $quote): void;
}
