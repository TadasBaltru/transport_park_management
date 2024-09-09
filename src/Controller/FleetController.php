<?php

namespace App\Controller;

use App\Entity\Fleet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class FleetController extends AbstractController
{
    #[Route('/fleet', name: 'app_fleet')]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $fleets = $entityManager->getRepository(Fleet::class)->findAll();
        dd($fleets);
        return $this->json($fleets);
    }
}
