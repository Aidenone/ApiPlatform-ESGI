<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Validator\Constraints\LogicDateBorrow;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\BorrowRepository")
 */
class Borrow
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
    private $borrowingDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @LogicDateBorrow
     */
    private $returnDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Borrower", inversedBy="borrows")
     */
    private $borrowers;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Copybook", cascade={"persist", "remove"})
     */
    private $copybook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowingDate(): ?\DateTimeInterface
    {
        return $this->borrowingDate;
    }

    public function setBorrowingDate(\DateTimeInterface $borrowingDate): self
    {
        $this->borrowingDate = $borrowingDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(?\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getBorrowers(): ?Borrower
    {
        return $this->borrowers;
    }

    public function setBorrowers(?Borrower $borrowers): self
    {
        $this->borrowers = $borrowers;

        return $this;
    }

    public function getCopybook(): ?Copybook
    {
        return $this->copybook;
    }

    public function setCopybook(?Copybook $copybook): self
    {
        $this->copybook = $copybook;

        return $this;
    }
}