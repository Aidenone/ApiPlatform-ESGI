<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book_read"}},
 *     denormalizationContext={"groups"={"book_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"book_read"})
     */
    private $id;

    /**
     * @var string Book's reference
     * @Groups({"book_read","book_write"})
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @Groups({"book_read","book_write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"book_read","book_write"})
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @Groups({"book_read","book_write"})
     * @ORM\Column(type="datetime")
     */
    private $publicationDate;

    /**
     * @Groups({"book_read","book_write"})
     * @var string Author's foreign key
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     * @ApiSubresource()
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Copybook", mappedBy="book")
     * ApiSubresource()
     * @Groups({"book_read","book_write"})
     */
    private $copybooks;

    public function __construct()
    {
        $this->copybooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Copybook[]
     */
    public function getCopybooks(): Collection
    {
        return $this->copybooks;
    }

    public function addCopybook(Copybook $copybook): self
    {
        if (!$this->copybooks->contains($copybook)) {
            $this->copybooks[] = $copybook;
            $copybook->setBook($this);
        }

        return $this;
    }

    public function removeCopybook(Copybook $copybook): self
    {
        if ($this->copybooks->contains($copybook)) {
            $this->copybooks->removeElement($copybook);
            // set the owning side to null (unless already changed)
            if ($copybook->getBook() === $this) {
                $copybook->setBook(null);
            }
        }

        return $this;
    }
}
