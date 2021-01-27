<?php

namespace App\Entity;

use App\Repository\ContratosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratosRepository::class)
 */
class Contratos
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
    private $contrato;

    /**
     * @ORM\Column(type="integer")
     */
    private $monto;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="monto")
     */
    private $clienteid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContrato(): ?string
    {
        return $this->contrato;
    }

    public function setContrato(string $contrato): self
    {
        $this->contrato = $contrato;

        return $this;
    }

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(int $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getClienteid(): ?Cliente
    {
        return $this->clienteid;
    }

    public function setClienteid(?Cliente $clienteid): self
    {
        $this->clienteid = $clienteid;

        return $this;
    }
}
