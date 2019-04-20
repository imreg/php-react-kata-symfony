<?php

namespace App\Repository;

use App\Entity\Quote;
use App\Repository\Interfaces\QuoteRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Quote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class QuoteRepository extends ServiceEntityRepository implements QuoteRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Quote::class);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Quote
    {
        return $this->find($id);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return parent::findAll();
    }

    /**
     * @param Quote $quote
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Quote $quote): void
    {
        $this->getEntityManager()->persist($quote);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Quote $quote
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Quote $quote): void
    {
        $this->getEntityManager()->remove($quote);
        $this->getEntityManager()->flush();
    }
}
