<?php

namespace App\Repository;

use App\Entity\Fleet;
use App\QueryTraits\SearchQueryFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @extends ServiceEntityRepository<Fleet>
 */
class FleetRepository extends ServiceEntityRepository
{
    use SearchQueryFormation;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fleet::class);
    }


    public function SelectAll(EntityManagerInterface $entityManager, array $searchParam): array
    {
        $searchValueKeys = array('id', 'status', 'truckId', 'truckLicenceNumber', 'trailerId', 'trailerLicenceNumber');
        $queryFieldNames = array('t.id', 't.status', 'truck.id', 'truck.licenseNumber', 'trailer.id', 'trailer.licenseNumber');

        $searchQuery = $this->SearchStringFormationFromRequest($searchParam, $searchValueKeys, $queryFieldNames);

        $fleets = $entityManager->createQuery("SELECT t.id, t.status, trailer.id as trailerID, trailer.licenseNumber as trailerLicenseNumber ,truck.id as truckId, truck.licenseNumber as truckLicenseNumber  FROM App\Entity\Fleet t LEFT JOIN t.trailer trailer LEFT JOIN t.truck truck  $searchQuery  ORDER BY t.id desc");
        return $fleets->getArrayResult();
    }
    public function SelectById(EntityManagerInterface $entityManager, int $id): array
    {
        $fleets = $entityManager->createQuery("SELECT t.id, t.status, trailer.id as trailerID, trailer.licenseNumber as trailerLicenseNumber ,truck.id as truckId, truck.licenseNumber as truckLicenseNumber  FROM App\Entity\Fleet t LEFT JOIN t.trailer trailer LEFT JOIN t.truck truck where t.id = :id")->setParameter('id', $id);
        return $fleets->getArrayResult();
    }

}
