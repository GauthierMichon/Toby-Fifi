<?php

namespace App\Entity;

use App\Repository\ParrainageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParrainageRepository::class)
 */
class Parrainage
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
    private $id_parrain;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_filleul;

    /**
     * @ORM\Column(type="date")
     */
    private $date_parrainage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdParrain(): ?int
    {
        return $this->id_parrain;
    }

    public function setIdParrain(int $id_parrain): self
    {
        $this->id_parrain = $id_parrain;

        return $this;
    }

    public function getIdFilleul(): ?int
    {
        return $this->id_filleul;
    }

    public function setIdFilleul(int $id_filleul): self
    {
        $this->id_filleul = $id_filleul;

        return $this;
    }

    public function getDateParrainage(): ?\DateTimeInterface
    {
        return $this->date_parrainage;
    }

    public function setDateParrainage(\DateTimeInterface $date_parrainage): self
    {
        $this->date_parrainage = $date_parrainage;

        return $this;
    }
}
