<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Alimentation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Transport = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Sante = null;

    /**
     * @var Collection<int, Transaction>
     */
    #[ORM\ManyToMany(targetEntity: Transaction::class, mappedBy: 'category')]
    private Collection $transactions;

    #[ORM\OneToOne(mappedBy: 'category', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlimentation(): ?string
    {
        return $this->Alimentation;
    }

    public function setAlimentation(?string $Alimentation): static
    {
        $this->Alimentation = $Alimentation;

        return $this;
    }

    public function getTransport(): ?string
    {
        return $this->Transport;
    }

    public function setTransport(?string $Transport): static
    {
        $this->Transport = $Transport;

        return $this;
    }

    public function getSante(): ?string
    {
        return $this->Sante;
    }

    public function setSante(?string $Sante): static
    {
        $this->Sante = $Sante;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): static
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->addCategory($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): static
    {
        if ($this->transactions->removeElement($transaction)) {
            $transaction->removeCategory($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setCategory(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getCategory() !== $this) {
            $user->setCategory($this);
        }

        $this->user = $user;

        return $this;
    }
}
