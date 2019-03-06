<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservations")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="reservation")
     */
    private $tickets;

    /**
     * @ORM\Column(type="integer")
     */
    private $luggage;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|Tickets[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTickets(Tickets $tickets): self
    {
        if (!$this->tickets->contains($tickets)) {
            $this->tickets[] = $tickets;
            $tickets->setReservation($this);
        }

        return $this;
    }

    public function removeTickets(Tickets $tickets): self
    {
        if ($this->tickets->contains($tickets)) {
            $this->tickets->removeElement($tickets);
            // set the owning side to null (unless already changed)
            if ($tickets->getReservation() === $this) {
                $tickets->setReservation(null);
            }
        }

        return $this;
    }

    public function getLuggage(): ?int
    {
        return $this->luggage;
    }

    public function setLuggage(int $luggage): self
    {
        $this->luggage = $luggage;

        return $this;
    }
}
