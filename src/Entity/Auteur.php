<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'auteurs', targetEntity: Article::class)]
    private Collection $Listes_Articles;

    public function __construct()
    {
        $this->Listes_Articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function addListesArticle(Article $listesArticle): static
    {
        if (!$this->Listes_Articles->contains($listesArticle)) {
            $this->Listes_Articles->add($listesArticle);
            $listesArticle->setAuteurs($this);
        }

        return $this;
    }

    public function removeListesArticle(Article $listesArticle): static
    {
        if ($this->Listes_Articles->removeElement($listesArticle)) {
            // set the owning side to null (unless already changed)
            if ($listesArticle->getAuteurs() === $this) {
                $listesArticle->setAuteurs(null);
            }
        }

        return $this;
    }
}
