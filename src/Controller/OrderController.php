<?php

namespace App\Controller;

use App\Repository\HistoryRepository;
use App\Repository\OrderRepository;
use App\Repository\OrderStatusHistoryRepository;
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
    #[Route('/order/history/{id<\d+>}', name: 'app_order_one')]

    public function findHistory(HistoryRepository $OrderHistory,EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        return $this->json($OrderHistory->SpecificOrderHistory($entityManager, $id));

    }

}
