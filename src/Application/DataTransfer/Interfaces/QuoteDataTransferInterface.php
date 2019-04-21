<?php


namespace App\Application\DataTransfer\Interfaces;

interface QuoteDataTransferInterface
{
    /**
     * @return string
     */
    public function getReferenceNumber(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getPremiumAmount(): int;
}
