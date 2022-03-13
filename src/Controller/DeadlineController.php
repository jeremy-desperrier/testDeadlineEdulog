<?php

namespace App\Controller;

use App\Entity\Deadline;
use App\Repository\DeadlineRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class DeadlineController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var DeadlineRepository
     */
    private $deadLineRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->deadLineRepository = $entityManager->getRepository(Deadline::class);
    }

    /**
     * @Route("/nextdeadlines", name="next_deadline")
     */
    public function actionDeadlineUntilNextFriday(): JsonResponse
    {
        $data = $this->formatDeadline($this->deadLineRepository->findAllUntilNextFriday());

        return new JsonResponse($data);
    }

    /**
     * @Route("/alldeadlines", name="all_deadline")
     */
    public function actionAllDeadline(): JsonResponse
    {
        $data = $this->formatDeadline($this->deadLineRepository->findAllDeadlines());
        return new JsonResponse($data);
    }

    /**
     * @Route("/validate/{idDeadline}", name="deadline_validate")
     */
    public function actionValidateDeadLine(int $idDeadline): JsonResponse
    {
        $deadline = $this->deadLineRepository->findOneById($idDeadline);
        if($deadline) {
            $deadline->setIsDone(true);
            $this->entityManager->flush($deadline);
            return new JsonResponse(['status' => 200]);
        }

        return new JsonResponse(['status' => 400]);
    }

    private function formatDeadline($deadlines) {
        $now = new \DateTime();
        $data = [];
        foreach ($deadlines as $deadline) {
            $data[] = [
                'id' => $deadline->getId(),
                'dayUntilDeadline' => $now->diff($deadline->getDueDate()),
                'late' => $now > $deadline->getDueDate()? 'EN RETARD':'PAS EN RETARD',
                'deadline' => $deadline->getDueDate()
            ];
        }
        return $data;
    }


}
