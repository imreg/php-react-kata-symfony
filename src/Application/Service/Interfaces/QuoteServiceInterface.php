<?php


namespace App\Application\Service\Interfaces;

use App\Application\DataTransfer\QuoteDataTransfer;
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
     * @param QuoteDataTransfer $quoteDataTransfer
     * @return Quote
     */
    public function addQuote(QuoteDataTransfer $quoteDataTransfer): ?Quote;

    /**
     * @param int $id
     * @param QuoteDataTransfer $quoteDataTransfer
     * @return Quote
     */
    public function updateQuote(int $id, QuoteDataTransfer $quoteDataTransfer): ?Quote;

    /**
     * @param int $id
     */
    public function delete(int $id): void;
}
