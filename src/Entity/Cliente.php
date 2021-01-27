<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
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
    private $clientes;

    /**
     * @ORM\OneToMany(targetEntity=Contratos::class, mappedBy="clienteid")
     */
    private $monto;

    public function __construct()
    {
        $this->monto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientes(): ?string
    {
        return $this->clientes;
    }

    public function setClientes(string $clientes): self
    {
        $this->clientes = $clientes;

        return $this;
    }

    /**
     * @return Collection|Contratos[]
     */
    public function getMonto(): Collection
    {
        return $this->monto;
    }

    public function addMonto(Contratos $monto): self
    {
        if (!$this->monto->contains($monto)) {
            $this->monto[] = $monto;
            $monto->setClienteid($this);
        }

        return $this;
    }

    public function removeMonto(Contratos $monto): self
    {
        if ($this->monto->removeElement($monto)) {
            // set the owning side to null (unless already changed)
            if ($monto->getClienteid() === $this) {
                $monto->setClienteid(null);
            }
        }

        return $this;
    }
}
