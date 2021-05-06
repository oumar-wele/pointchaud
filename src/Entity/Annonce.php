<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 * @ORM\Table(name="annonces")
 * @ORM\HasLifecycleCallbacks()
 */

class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champs titre est requis")
     * @Assert\Length(min=5, minMessage="Vous devez saisir au moin 5 caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le champs description est requis")
     * @Assert\Length(min=10,minMessage="Vous devez saisir au moin 5 caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime",options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime",options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champs prix est requis")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimetamps()
    {
        if($this->getCreatedAt()===null){
            $this->setCreatedAt( new \DateTimeImmutable);

        }
        
        $this->setUpdatedAt( new \DateTimeImmutable);
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }
}
