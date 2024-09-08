<?php

namespace App\Entity;

use App\Repository\TruckRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TruckRepository::class)]
class Truck
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $licenseNumber = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\OneToOne(mappedBy: 'truck', cascade: ['persist', 'remove'])]
    private ?Fleet $fleet_id = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'truck_id')]
    private Collection $order_id;

    public function __construct()
    {
        $this->order_id = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLicenseNumber(): ?string
    {
        return $this->licenseNumber;
    }

    public function setLicenseNumber(string $licenseNumber): static
    {
        $this->licenseNumber = $licenseNumber;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Fleet>
     */
    public function getFleet(): Collection
    {
        return $this->fleet;
    }

    public function addFleet(Fleet $fleet): static
    {
        if (!$this->fleet->contains($fleet)) {
            $this->fleet->add($fleet);
            $fleet->setTruck($this);
        }

        return $this;
    }

    public function removeFleet(Fleet $fleet): static
    {
        if ($this->fleet->removeElement($fleet)) {
            // set the owning side to null (unless already changed)
            if ($fleet->getTruck() === $this) {
                $fleet->setTruck(null);
            }
        }

        return $this;
    }

    public function getFleetId(): ?Fleet
    {
        return $this->fleet_id;
    }

    public function setFleetId(Fleet $fleet_id): static
    {
        // set the owning side of the relation if necessary
        if ($fleet_id->getTruck() !== $this) {
            $fleet_id->setTruck($this);
        }

        $this->fleet_id = $fleet_id;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderId(): Collection
    {
        return $this->order_id;
    }

    public function addOrderId(Order $orderId): static
    {
        if (!$this->order_id->contains($orderId)) {
            $this->order_id->add($orderId);
            $orderId->setTruckId($this);
        }

        return $this;
    }

    public function removeOrderId(Order $orderId): static
    {
        if ($this->order_id->removeElement($orderId)) {
            // set the owning side to null (unless already changed)
            if ($orderId->getTruckId() === $this) {
                $orderId->setTruckId(null);
            }
        }

        return $this;
    }
}
