<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TravelRepository")
 */
class Travel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departureDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrivalDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Gate", cascade={"persist", "remove"})
     */
    private $departurePlace;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Gate", cascade={"persist", "remove"})
     */
    private $arrivalPlace;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Plane", cascade={"persist", "remove"})
     */
    private $plane;

    /**
     * @ORM\Column(type="integer")
     */
    private $firstClassRemaining = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $secondClassRemaining = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="travel")
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDeparturePlace(): ?Gate
    {
        return $this->departurePlace;
    }

    public function setDeparturePlace(?Gate $departurePlace): self
    {
        $this->departurePlace = $departurePlace;

        return $this;
    }

    public function getArrivalPlace(): ?Gate
    {
        return $this->arrivalPlace;
    }

    public function setArrivalPlace(?Gate $arrivalPlace): self
    {
        $this->arrivalPlace = $arrivalPlace;

        return $this;
    }

    public function getPlane(): ?Plane
    {
        return $this->plane;
    }

    public function setPlane(?Plane $plane): self
    {
        $this->plane = $plane;

        return $this;
    }

    public function getFirstClassRemaining(): ?int
    {
        return $this->firstClassRemaining;
    }

    public function setFirstClassRemaining(int $firstClassRemaining): self
    {
        $this->firstClassRemaining = $firstClassRemaining;

        return $this;
    }

    public function getSecondClassRemaining(): ?int
    {
        return $this->secondClassRemaining;
    }

    public function setSecondClassRemaining(int $secondClassRemaining): self
    {
        $this->secondClassRemaining = $secondClassRemaining;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setTravel($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getTravel() === $this) {
                $ticket->setTravel(null);
            }
        }

        return $this;
    }
}
