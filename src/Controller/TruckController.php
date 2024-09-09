<?php

namespace App\Controller;

use App\QueryTraits\RelationWithFleetTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TruckController extends AbstractController
{
    use RelationWithFleetTrait;
    #[Route('/truck', name: 'app_truck')]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->SelectWithFleet($entityManager, 'App\Entity\Truck');
    }
    #[Route('/truck/{id<\d+>}', name: 'app_trailer_one')]
    public function findOne(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        return $this->SelectWithEntityId($entityManager, 'App\Entity\Truck', $id);
    }
}
