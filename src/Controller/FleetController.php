<?php

namespace App\Controller;

use App\Entity\Fleet;
use App\QueryTraits\SelectQuery;
use App\Repository\FleetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class FleetController extends AbstractController
{
    use SelectQuery;
    #[Route('/fleet', name: 'app_fleet')]
    public function index(FleetRepository $fleetRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->json($fleetRepository->SelectAll($entityManager));
    }
}
