<?php


namespace App\Application\DataTransfer;

use App\Application\DataTransfer\Interfaces\QuoteDataTransferInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class QuoteDataTransfer implements QuoteDataTransferInterface
{

    /**
     * @var string
     * @Assert\NotBlank(groups={"quoteGroup"})
     * @Assert\Length(min=3,groups={"quoteGroup"})
     */
    private $referenceNumber;

    /**
     * @var string
     * @Assert\NotBlank(groups={"quoteGroup"})
     * @Assert\Length(min=3,groups={"quoteGroup"})
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(groups={"quoteGroup"})
     * @Assert\Length(min=3,groups={"quoteGroup"})
     */
    private $premiumAmount;

    /**
     * QuoteDataTransfer constructor.
     * @param string $referenceNumber
     * @param string $description
     * @param int $premiumAmount
     */
    public function __construct(string $referenceNumber, string $description, int $premiumAmount)
    {
        $this->referenceNumber = $referenceNumber;
        $this->description = $description;
        $this->premiumAmount = $premiumAmount;
    }

    /**
     * @inheritDoc
     */
    public function getReferenceNumber(): string
    {
        return $this->referenceNumber;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function getPremiumAmount(): int
    {
        if (preg_match('/\d+[.]\d+/', $this->premiumAmount)) {
            return (int)($this->premiumAmount * 100);
        }

        return $this->premiumAmount;
    }
}
