<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @Groups({"book_read"})
     * @ORM\Column(type="integer")
     */
    private $copyBookNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="copybooks")
     */
    private $book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCopyBookNumber(): ?int
    {
        return $this->copyBookNumber;
    }

    public function setCopyBookNumber(int $copyBookNumber): self
    {
        $this->copyBookNumber = $copyBookNumber;

        return $this;
    }

    public function getBook(): ?book
    {
        return $this->book;
    }

    public function setBook(?book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
