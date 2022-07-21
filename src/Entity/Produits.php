<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_produit;

    /**
     * @ORM\Column(type="text")
     */
    private $description_produit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_produit;

    /**
     * @ORM\Column(type="boolean")
     */
    private $stock_produit;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_produit;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_produit;

    /**
     * @ORM\OneToOne(targetEntity=References::class, cascade={"persist", "remove"})
     */
    private $numero;


    /**
     * @ORM\ManyToMany(targetEntity=Distributeur::class, inversedBy="produits")
     */
    private $distributeur;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="produits")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="produits")
     */
    private $utilisateurs;





    public function __construct()
    {
        $this->distributeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getDescriptionProduit(): ?string
    {
        return $this->description_produit;
    }

    public function setDescriptionProduit(string $description_produit): self
    {
        $this->description_produit = $description_produit;

        return $this;
    }

    public function getImageProduit(): ?string
    {
        return $this->image_produit;
    }

    public function setImageProduit(string $image_produit): self
    {
        $this->image_produit = $image_produit;

        return $this;
    }

    public function isStockProduit(): ?bool
    {
        return $this->stock_produit;
    }

    public function setStockProduit(bool $stock_produit): self
    {
        $this->stock_produit = $stock_produit;

        return $this;
    }

    public function getDateProduit(): ?\DateTimeInterface
    {
        return $this->date_produit;
    }

    public function setDateProduit(\DateTimeInterface $date_produit): self
    {
        $this->date_produit = $date_produit;

        return $this;
    }

    public function getPrixProduit(): ?float
    {
        return $this->prix_produit;
    }

    public function setPrixProduit(float $prix_produit): self
    {
        $this->prix_produit = $prix_produit;

        return $this;
    }

    public function getNumero(): ?References
    {
        return $this->numero;
    }

    public function setNumero(?References $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDistributeur(): Collection
    {
        return $this->distributeur;
    }

    public function setDistributeur(string $distributeur): self
    {
        if (!$this->distributeur->contains($distributeur)) {
            $this->distributeur[] = $distributeur;
        }

        return $this;
    }

    public function addDistributeur(Distributeur $distributeur): self
    {
        if (!$this->distributeur->contains($distributeur)) {
            $this->distributeur[] = $distributeur;
        }

        return $this;
    }

    public function removeDistributeur(Distributeur $distributeur): self
    {
        $this->distributeur->removeElement($distributeur);

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getUtilisateurs(): ?User
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?User $utilisateurs): self
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }


}
