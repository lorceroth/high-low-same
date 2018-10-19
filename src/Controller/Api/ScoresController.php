<?php

namespace App\Controller\Api;

use App\Model\Score;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/scores")
 */
class ScoresController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(EntityManagerInterface $manager, SerializerInterface $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/top", methods={"GET"}, name="top_scroes")
     */
    public function getTopScore(): Response
    {
        $scores = $this->manager
            ->getRepository(Score::class)
            ->findBy([], ['score' => 'DESC']);

        return $this->json([
            'scores' => $scores,
        ]);
    }

    /**
     * @Route("/save", methods={"POST"}, name="save_score")
     */
    public function save(Request $request): Response
    {
        $score = $this->serializer->deserialize($request->getContent(), Score::class, 'json');
        $score->setPLayedDate(new \DateTime());

        $this->manager->persist($score);
        $this->manager->flush();

        return $this->json([
            'score' => $score,
        ]);
    }
}
