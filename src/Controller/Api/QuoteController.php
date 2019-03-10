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
        // This is very very temp solution
        $entityManager = $this->getDoctrine()->getManager();
        $quote = new Quote();

        $quote->setReferenceNumber($request->get('referenceNumber'));
        $quote->setDescription($request->get('description'));
        $quote->setPremiumAmount($request->get('premiumAmount'));
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
