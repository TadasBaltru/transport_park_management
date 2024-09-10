<?php

namespace App\Controller;

use App\QueryTraits\RelationWithFleetTrait;
use App\QueryTraits\SearchQueryFormation;
use App\Repository\TruckRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TruckController extends AbstractController
{
    use RelationWithFleetTrait;
    use SearchQueryFormation;
    #[Route('/truck', name: 'app_truck')]
    public function index(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $searchParam = $request->query->all();
        $searchValueKeys = array('licenseNumber', 'status', 'fleet_id');
        $queryFieldNames = array('t.licenseNumber', 't.status', 'f.id');
        $searchParam = $this->SearchStringFormationFromRequest($searchParam, $searchValueKeys, $queryFieldNames);

        return $this->SelectWithFleet($entityManager, 'App\Entity\Truck', $searchParam);
    }
    #[Route('/truck/{id<\d+>}', name: 'app_truck_one')]
    public function findOne(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $truck = TruckRepository::class;
        if (!$truck) {
            return $this->json(['error' => 'truck not found']);
        }
        return $this->SelectWithEntityId($entityManager, 'App\Entity\Truck', $id);
    }
}
