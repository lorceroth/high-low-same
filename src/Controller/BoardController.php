<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="board")
     */
    public function index(): Response
    {
        return $this->render('board/index.html.twig');
    }
}
