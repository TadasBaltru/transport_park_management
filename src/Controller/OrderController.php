<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(OrderRepository $OrderRepository, EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $searchParam = $request->query->all();
        return $this->json($OrderRepository->SelectAll($entityManager, $searchParam));
    }
    #[Route('/order/{id<\d+>}', name: 'app_order_one')]

    public function findOne(OrderRepository $OrderRepository,EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        return $this->json($OrderRepository->SelectById($entityManager, $id));

    }
}
