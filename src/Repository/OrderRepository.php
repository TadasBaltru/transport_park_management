<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function SelectAll(EntityManagerInterface $entityManager): array
    {
        $orders = $entityManager->createQuery("SELECT ord, truck.id as truckId, truck.licenseNumber as truckLicenceNumber, trailer.id as trailerId, trailer.licenseNumber as truckLicenseNumber, fleet.id as fleetId FROM App\Entity\Order ord LEFT JOIN ord.trailer trailer LEFT JOIN ord.truck truck LEFT JOIN ord.fleet fleet  ORDER BY ord.id desc ");

        return $orders->getArrayResult();

    }
}
