<?php

namespace App\QueryTraits;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

trait RelationWithFleetTrait
{

    public function SelectWithFleet(EntityManagerInterface $entityManager, string $entity_path): JsonResponse
    {
        $EntityRelatedToFleet = $entityManager->createQuery("SELECT t, f.id as fleet_id FROM $entity_path t LEFT JOIN t.fleet_id f");
        return $this->json($EntityRelatedToFleet->getArrayResult());

    }

}