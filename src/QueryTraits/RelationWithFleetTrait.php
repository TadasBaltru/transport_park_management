<?php

namespace App\QueryTraits;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

trait RelationWithFleetTrait
{

    public function SelectWithFleet(EntityManagerInterface $entityManager, string $entity_path): JsonResponse
    {
        $EntityRelatedToFleet = $entityManager->createQuery("SELECT t.id, t.licenseNumber, t.status, f.id as fleet_id FROM $entity_path t LEFT JOIN t.fleet_id f ORDER BY t.id DESC");
        return $this->json($EntityRelatedToFleet->getArrayResult());

    }
    public function SelectWithEntityId(EntityManagerInterface $entityManager, string $entity_path, int $id): JsonResponse
    {
        $EntityRelatedToFleet = $entityManager->createQuery("SELECT t.id, t.licenseNumber, t.statusas fleet_id FROM $entity_path t LEFT JOIN t.fleet_id f where t.id = $id ORDER BY t.id DESC");
        return $this->json($EntityRelatedToFleet->getArrayResult());
    }

}