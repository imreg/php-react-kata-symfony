<?php

namespace App\Controller\Api;

use App\Entity\Quote;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class QuoteController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/create")
     */
    public function createQuote(Request $request): View
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

        if (preg_match('/\d+[.]\d+/', $premiumAmount)) {
            $premiumAmount = (int)($premiumAmount * 100);
        }

        // This is very very temp solution
        $entityManager = $this->getDoctrine()->getManager();
        $quote = new Quote();

        $quote->setReferenceNumber($referenceNumber);
        $quote->setDescription($description);
        $quote->setPremiumAmount($premiumAmount);
        $quote->setDateCreated(new \DateTime());

        $entityManager->persist($quote);
        $entityManager->flush();

        // In case our POST was a success we need to return a 201 HTTP CREATED response
        return View::create($quote, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/all")
     */
    public function getAllQuote(): View
    {
        // This is a temp solution
        $repository = $this->getDoctrine()->getRepository(Quote::class);
        $quote = $repository->findAll();
        return View::create($quote, Response::HTTP_OK);
    }
}
