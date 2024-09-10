<?php

namespace App\Controller;

use App\Entity\Trailer;
use App\QueryTraits\RelationWithFleetTrait;
use App\QueryTraits\SearchQueryFormation;
use App\Repository\TrailerRepository;
use App\Repository\TruckRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\TypeInfo\Type\CollectionType;

class TrailerController extends AbstractController
{
    use RelationWithFleetTrait;
    use SearchQueryFormation;
    #[Route('/trailer', name: 'app_trailer')]
    public function index(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $searchParam = $request->query->all();
        $searchValueKeys = array('licenseNumber', 'status', 'fleet_id');
        $queryFieldNames = array('t.licenseNumber', 't.status', 'f.id');

        $searchParam = $this->SearchStringFormationFromRequest($searchParam, $searchValueKeys, $queryFieldNames);

        return $this->SelectWithFleet($entityManager, 'App\Entity\Trailer', $searchParam);
    }
    #[Route('/trailer/{id<\d+>}', name: 'app_trailer_one')]

    public function findOne(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $trailer = TrailerRepository::class;
        if (!$trailer) {
            return $this->json(['error' => 'truck not found']);
        }
        return $this->SelectWithEntityId($entityManager, 'App\Entity\Trailer', $id);
    }
}
