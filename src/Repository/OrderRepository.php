<?php

namespace App\Repository;

use App\Entity\Order;
use App\QueryTraits\SearchQueryFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    use SearchQueryFormation;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function SelectAll(EntityManagerInterface $entityManager, array $searchParam): array
    {

        $searchValueKeys = array('id', 'status', 'createdAt', 'truckId', 'truckLicenceNumber', 'trailerId', 'trailerLicenceNumber', 'fleetId');
        $queryFieldNames = array('ord.id', 'ord.status', 'ord.createdAt', 'truck.id', 'truck.licenseNumber', 'trailer.id', 'trailer.licenseNumber', 'fleet.id');

        $searchQuery = $this->SearchStringFormationFromRequest($searchParam, $searchValueKeys, $queryFieldNames);
        $orders = $entityManager->createQuery("SELECT ord.id, ord.status, ord.createdAt, truck.id as truckId, truck.licenseNumber as truckLicenceNumber, trailer.id as trailerId, trailer.licenseNumber as truckLicenseNumber, fleet.id as fleetId, fleet_truck.id as fleetTruckId, fleet_truck.licenseNumber as fleetTruckLicenseNumber, fleet_trailer.id as fleetTrailerId, fleet_trailer.licenseNumber as fleetTrailerLicenseNumber  FROM App\Entity\Order ord LEFT JOIN ord.trailer trailer LEFT JOIN ord.truck truck LEFT JOIN ord.fleet fleet  LEFT JOIN fleet.truck fleet_truck LEFT JOIN fleet.trailer fleet_trailer  $searchQuery  ORDER BY ord.id desc ");


        return $orders->getArrayResult();

    }
    public function SelectById(EntityManagerInterface $entityManager, int $id): array
    {
        $orders = $entityManager->createQuery("SELECT ord.id, ord.status, ord.createdAt, truck.id as truckId, truck.licenseNumber as truckLicenceNumber, trailer.id as trailerId, trailer.licenseNumber as truckLicenseNumber, fleet.id as fleetId, fleet_truck.id as fleetTruckId, fleet_truck.licenseNumber as fleetTruckLicenseNumber, fleet_trailer.id as fleetTrailerId, fleet_trailer.licenseNumber as fleetTrailerLicenseNumber  FROM App\Entity\Order ord LEFT JOIN ord.trailer trailer LEFT JOIN ord.truck truck LEFT JOIN ord.fleet fleet  LEFT JOIN fleet.truck fleet_truck LEFT JOIN fleet.trailer fleet_trailer where ord.id = :id  ")->setParameter('id', $id);

        return $orders->getArrayResult();

    }
}
