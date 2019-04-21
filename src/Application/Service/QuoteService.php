<?php

namespace App\Application\Service;

use App\Application\DataTransfer\QuoteDataTransfer;
use App\Application\Service\Interfaces\QuoteServiceInterface;
use App\Entity\Quote;
use App\Repository\Interfaces\QuoteRepositoryInterface;
use Doctrine\ORM\ORMException;

/**
 * Class QuoteService
 * @package App\Application\Service
 */
final class QuoteService implements QuoteServiceInterface
{
    /**
     * @var QuoteRepositoryInterface
     */
    private $quoteRepository;

    /**
     * QuoteService constructor.
     * @param QuoteRepositoryInterface $quoteRepository
     */
    public function __construct(QuoteRepositoryInterface $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @inheritDoc
     */
    public function oneQuote(int $id): ?Quote
    {
        return $this->quoteRepository->findById($id);
    }

    /**
     * @inheritDoc
     */
    public function quotes(): ?array
    {
        return $this->quoteRepository->findAll();
    }

    /**
     * @inheritDoc
     */
    public function addQuote(QuoteDataTransfer $quoteDataTransfer): ?Quote
    {
        $quote = new Quote();

        $quote->setReferenceNumber($quoteDataTransfer->getReferenceNumber());
        $quote->setDescription($quoteDataTransfer->getDescription());
        $quote->setPremiumAmount($quoteDataTransfer->getPremiumAmount());
        $quote->setDateCreated(new \DateTime());

        $this->quoteRepository->save($quote);

        return $quote;
    }

    /**
     * @inheritDoc
     */
    public function updateQuote(int $id, QuoteDataTransfer $quoteDataTransfer): ?Quote
    {
        $quote = $this->oneQuote($id);

        if (!$quote === null) {
            return null;
        }

        $quote->setReferenceNumber($quoteDataTransfer->getReferenceNumber());
        $quote->setDescription($quoteDataTransfer->getDescription());
        $quote->setPremiumAmount($quoteDataTransfer->getPremiumAmount());
        $quote->setDateCreated(new \DateTime());

        $this->quoteRepository->save($quote);

        return $quote;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        $quote = $this->oneQuote($id);
        if ($quote !== null) {
            $this->quoteRepository->delete($quote);
        }
    }
}
