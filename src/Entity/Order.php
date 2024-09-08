<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'order_id')]
    private ?Fleet $fleet_id = null;

    #[ORM\ManyToOne(inversedBy: 'order_id')]
    private ?Truck $truck_id = null;

    #[ORM\ManyToOne(inversedBy: 'order_id')]
    private ?Trailer $trailer_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFleetId(): ?Fleet
    {
        return $this->fleet_id;
    }

    public function setFleetId(?Fleet $fleet_id): static
    {
        $this->fleet_id = $fleet_id;

        return $this;
    }

    public function getTruckId(): ?Truck
    {
        return $this->truck_id;
    }

    public function setTruckId(?Truck $truck_id): static
    {
        $this->truck_id = $truck_id;

        return $this;
    }

    public function getTrailerId(): ?Trailer
    {
        return $this->trailer_id;
    }

    public function setTrailerId(?Trailer $trailer_id): static
    {
        $this->trailer_id = $trailer_id;

        return $this;
    }
}
