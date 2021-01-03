<?php

namespace App\Entity;

use App\Repository\BonAchatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BonAchatRepository::class)
 */
class BonAchat
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
    private $code;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $fixe;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pourcentage;

    /**
     * @ORM\Column(type="float")
     */
    private $reduction;

    /**
     * @ORM\Column(type="date")
     */
    private $date_peremption;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getFixe(): ?bool
    {
        return $this->fixe;
    }

    public function setFixe(?bool $fixe): self
    {
        $this->fixe = $fixe;

        return $this;
    }

    public function getPourcentage(): ?bool
    {
        return $this->pourcentage;
    }

    public function setPourcentage(?bool $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getReduction(): ?float
    {
        return $this->reduction;
    }

    public function setReduction(float $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getDatePeremption(): ?\DateTimeInterface
    {
        return $this->date_peremption;
    }

    public function setDatePeremption(\DateTimeInterface $date_peremption): self
    {
        $this->date_peremption = $date_peremption;

        return $this;
    }
}
