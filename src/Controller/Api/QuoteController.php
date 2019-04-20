<?php

namespace App\Controller\Api;

use App\Application\Service\QuoteService;
use App\Entity\Quote;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class QuoteController extends AbstractFOSRestController
{

    /**
     * @var QuoteService
     */
    private $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    /**
     * @Rest\Post("/quotes")
     */
    public function postQuotes(Request $request): View
    {
        $referenceNumber = $request->get('referenceNumber', null);
        $description = $request->get('description', null);
        $premiumAmount = $request->get('premiumAmount', null);

        if (empty($referenceNumber)
            && empty($description)
            && $premiumAmount === null
            && !is_numeric($premiumAmount)) {
            return View::create(['error' => 'invalid data'], Response::HTTP_BAD_REQUEST);
        }

        $quote = $this->quoteService->addQuote($referenceNumber, $description, $premiumAmount);

        return View::create($quote, Response::HTTP_CREATED);
    }

    /**
     * Replaces Quotes resource
     * @Rest\Put("/quotes/{id}")
     */
    public function putQuotes(Request $request): View
    {
        $referenceNumber = $request->get('referenceNumber', null);
        $description = $request->get('description', null);
        $premiumAmount = $request->get('premiumAmount', null);

        $id = $request->get('id', null);
        $quote = $this->quoteService->updateQuote($id, $referenceNumber, $description, $premiumAmount);
        return View::create($quote, Response::HTTP_OK);
    }

    /**
     * Replaces Quotes resource
     * @Rest\Put("/quotes/{id}")
     */
    public function deleteQuotes(Request $request): View
    {
        $id = $request->get('id', null);
        $this->quoteService->delete($id);
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Get("/quotes")
     */
    public function getQuotes(): View
    {
        $quote = $this->quoteService->quotes();
        return View::create($quote, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/quotes/{id}")
     */
    public function getQuote(Request $request): View
    {
        $id = $request->get('id', null);
        $quote = $this->quoteService->oneQuote($id);

        if ($quote === null) {
            return View::create(new Quote(), Response::HTTP_BAD_REQUEST);
        }

        return View::create($quote, Response::HTTP_OK);
    }
}
