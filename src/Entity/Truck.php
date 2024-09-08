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

    #[ORM\Column(length: 100)]
    private ?string $licenceNumber = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    /**
     * @var Collection<int, Fleet>
     */
    #[ORM\OneToOne(mappedBy: 'trailer', cascade: ['persist', 'remove'])]
    private Collection $fleet;

    public function __construct()
    {
        $this->fleet = new ArrayCollection();
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
}
