<?php

namespace App\Application\Service;

use App\Application\Service\Interfaces\QuoteServiceInterface;
use App\Entity\Quote;
use App\Repository\Interfaces\QuoteRepositoryInterface;

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
    public function addQuote(
        string $referenceNumber = null,
        string $description = null,
        string $premiumAmount = null
    ): Quote {

        if (preg_match('/\d+[.]\d+/', $premiumAmount)) {
            $premiumAmount = (int)($premiumAmount * 100);
        }

        $quote = new Quote();

        $quote->setReferenceNumber($referenceNumber);
        $quote->setDescription($description);
        $quote->setPremiumAmount($premiumAmount);
        $quote->setDateCreated(new \DateTime());

        $this->quoteRepository->save($quote);

        return $quote;
    }

    /**
     * @inheritDoc
     */
    public function updateQuote(int $id, string $referenceNumber, string $description, string $premiumAmount): Quote
    {
        $quote = $this->oneQuote($id);
        if (!$quote === null) {
            return null;
        }

        $quote->setReferenceNumber($referenceNumber);
        $quote->setDescription($description);
        $quote->setPremiumAmount($premiumAmount);
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
