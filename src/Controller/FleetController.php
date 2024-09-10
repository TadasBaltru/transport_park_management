<?php

namespace App\Controller;

use App\Entity\Fleet;
use App\QueryTraits\SelectQuery;
use App\Repository\FleetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class FleetController extends AbstractController
{
    #[Route('/fleet', name: 'app_fleet')]
    public function index(FleetRepository $fleetRepository, EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $searchParam = $request->query->all();

        return $this->json($fleetRepository->SelectAll($entityManager, $searchParam));
    }
    #[Route('/fleet/{id<\d+>}', name: 'app_fleet_one')]

    public function findOne(FleetRepository $fleetRepository,EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        return $this->json($fleetRepository->SelectById($entityManager, $id));
    }

}
