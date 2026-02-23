<?php

namespace App\Entity;

use App\Repository\PaymentMethodRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentMethodRepository::class)]
class PaymentMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $carte = null;

    #[ORM\Column(nullable: true)]
    private ?bool $espece = null;

    #[ORM\Column(nullable: true)]
    private ?bool $virement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCarte(): ?bool
    {
        return $this->carte;
    }

    public function setCarte(bool $carte): static
    {
        $this->carte = $carte;

        return $this;
    }

    public function isEspece(): ?bool
    {
        return $this->espece;
    }

    public function setEspece(?bool $espece): static
    {
        $this->espece = $espece;

        return $this;
    }

    public function isVirement(): ?bool
    {
        return $this->virement;
    }

    public function setVirement(?bool $virement): static
    {
        $this->virement = $virement;

        return $this;
    }
}
