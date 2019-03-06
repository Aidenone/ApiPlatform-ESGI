<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CopybookRepository")
 */
class Copybook
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $copybookNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="copybooks")
     */
    private $book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCopybookNumber(): ?int
    {
        return $this->copybookNumber;
    }

    public function setCopybookNumber(int $copybookNumber): self
    {
        $this->copybookNumber = $copybookNumber;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
