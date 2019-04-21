<?php

namespace App\Controller\Api;

use App\Application\DataTransfer\QuoteDataTransfer;
use App\Application\Service\QuoteService;
use App\Entity\Quote;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class QuoteController extends AbstractFOSRestController
{

    /**
     * @var QuoteService
     */
    private $quoteService;

    /**
     * QuoteController constructor.
     * @param QuoteService $quoteService
     */
    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    /**
     * @Rest\Post("/quotes")
     * @ParamConverter("quoteDataTransfer",
     *     converter="fos_rest.request_body",
     *     options={"validator"={"groups"={"quoteGroup"}}})
     *
     * @param QuoteDataTransfer $quoteDataTransfer
     * @param ConstraintViolationListInterface $validationErrors
     * @return View
     */
    public function postQuotes(
        QuoteDataTransfer $quoteDataTransfer,
        ConstraintViolationListInterface $validationErrors
    ): View {

        if (count($validationErrors) > 0) {
            $message = [];
            foreach ($validationErrors as $error) {
                $message[] = $error->getMessage();
            }
            return View::create(['error' => $message], Response::HTTP_NO_CONTENT);
        }

        $quote = $this->quoteService->addQuote($quoteDataTransfer);
        return View::create($quote, Response::HTTP_CREATED);
    }

    /**
     * Replaces Quotes resource
     * @Rest\Put("/quotes/{id}")
     * @ParamConverter("quoteDataTransfer",
     *     converter="fos_rest.request_body",
     *     options={"validator"={"groups"={"quoteGroup"}}})
     *
     * @param int $id
     * @param QuoteDataTransfer $quoteDataTransfer
     * @param ConstraintViolationListInterface $validationErrors
     * @return View
     */
    public function putQuotes(
        int $id,
        QuoteDataTransfer $quoteDataTransfer,
        ConstraintViolationListInterface $validationErrors
    ): View {
        $quote = $this->quoteService->updateQuote($id, $quoteDataTransfer);
        return View::create($quote, Response::HTTP_OK);
    }

    /**
     * Replaces Quotes resource
     * @Rest\Put("/quotes/{id}")
     * @param Request $request
     * @return View
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
