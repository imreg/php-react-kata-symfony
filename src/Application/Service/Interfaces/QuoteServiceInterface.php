<?php


namespace App\Application\Service\Interfaces;

use App\Entity\Quote;

/**
 * Interface QuoteServiceInterface
 * @package App\Application\Service\Interfaces
 */
interface QuoteServiceInterface
{

    /**
     * @param int $id
     * @return Quote|null
     */
    public function oneQuote(int $id): ?Quote;

    /**
     * @return array|null
     */
    public function quotes(): ?array;

    /**
     * @param string $referenceNumber
     * @param string $description
     * @param string $premiumAmount
     * @return Quote
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addQuote(string $referenceNumber, string $description, string $premiumAmount): Quote;

    /**
     * @param int $id
     * @param string $referenceNumber
     * @param string $description
     * @param string $premiumAmount
     * @return Quote
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateQuote(int $id, string $referenceNumber, string $description, string $premiumAmount): Quote;

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(int $id): void;
}
