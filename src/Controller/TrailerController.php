<?php

namespace App\Controller;

use App\Entity\Trailer;
use App\QueryTraits\RelationWithFleetTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TrailerController extends AbstractController
{
    use RelationWithFleetTrait;
    #[Route('/trailer', name: 'app_trailer')]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {

        return $this->SelectWithFleet($entityManager, 'App\Entity\Trailer');
    }
    #[Route('/trailer/{id<\d+>}', name: 'app_trailer_one')]

    public function findOne(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        return $this->SelectWithEntityId($entityManager, 'App\Entity\Trailer', $id);
    }
}
