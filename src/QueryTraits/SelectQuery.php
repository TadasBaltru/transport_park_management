<?php

namespace App\QueryTraits;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

trait SelectQuery
{
    public function SelectAll(EntityManagerInterface $entityManager, string $entity_path): JsonResponse
    {
        $EntityRelatedToFleet = $entityManager->createQuery("SELECT t FROM $entity_path t");
        return $this->json($EntityRelatedToFleet->getArrayResult());

    }
}