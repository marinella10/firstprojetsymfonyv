<?php

namespace App\Entity;

use App\Repository\ReferencesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReferencesRepository::class)
 * @ORM\Table(name="`references`")
 */
class References
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero_reference;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroReference(): ?int
    {
        return $this->numero_reference;
    }

    public function setNumeroReference(int $numero_reference): self
    {
        $this->numero_reference = $numero_reference;

        return $this;
    }

    public function __toString ()
    {
        return (string) $this->numero_reference;

    }
}
