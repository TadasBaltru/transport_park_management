<?php

namespace App\Entity;

use App\Repository\TrailerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrailerRepository::class)]
class Trailer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $licenceNumber = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\OneToOne(mappedBy: 'trailer', cascade: ['persist', 'remove'])]
    private ?Fleet $fleet_id = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'trailer_id')]
    private Collection $order_id;

    public function __construct()
    {
        $this->order_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLicenceNumber(): ?string
    {
        return $this->licenceNumber;
    }

    public function setLicenceNumber(string $licenceNumber): static
    {
        $this->licenceNumber = $licenceNumber;

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

    public function getFleetId(): ?Fleet
    {
        return $this->fleet_id;
    }

    public function setFleetId(Fleet $fleet_id): static
    {
        // set the owning side of the relation if necessary
        if ($fleet_id->getTrailer() !== $this) {
            $fleet_id->setTrailer($this);
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
            $orderId->setTrailerId($this);
        }

        return $this;
    }

    public function removeOrderId(Order $orderId): static
    {
        if ($this->order_id->removeElement($orderId)) {
            // set the owning side to null (unless already changed)
            if ($orderId->getTrailerId() === $this) {
                $orderId->setTrailerId(null);
            }
        }

        return $this;
    }
}
