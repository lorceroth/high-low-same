<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/decks")
 */
class DecksController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET"}, name="new_deck")
     */
    public function new(): Response
    {
        return $this->json([
            'message' => 'OK'
        ]);
    }
}
