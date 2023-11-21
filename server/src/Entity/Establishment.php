<?php

namespace App\Entity;

use App\Repository\EstablishmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    denormalizationContext: ['groups' => ['establishment:write']],
    normalizationContext: ['groups' => ['establishment:read']],
    operations: [
        new GetCollection(),
        new Post(),
        new Get(),
        new Patch(denormalizationContext: ['groups' => ['establishment:write:update']]),
    ],
)]
#[ORM\Table(name: '`establishment`')]
#[ORM\Entity()]
class Establishment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['provision:read', 'provider:read', 'employee:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[Groups(['provider:read', 'establishment:read'])]
    #[ORM\ManyToOne(inversedBy: 'establishments')]
    private ?Provider $provider = null;

    #[Groups(['establishment:read'])]
    #[ORM\ManyToMany(targetEntity: Provision::class, mappedBy: 'establishments')]
    private Collection $provisions;

    #[ORM\OneToMany(mappedBy: 'establishment', targetEntity: Employee::class)]
    private Collection $employees;

    public function __construct()
    {
        $this->provisions = new ArrayCollection();
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return Collection<int, Provision>
     */
    public function getProvisions(): Collection
    {
        return $this->provisions;
    }

    public function addProvision(Provision $provision): static
    {
        if (!$this->provisions->contains($provision)) {
            $this->provisions->add($provision);
            $provision->addEstablishment($this);
        }

        return $this;
    }

    public function removeProvision(Provision $provision): static
    {
        if ($this->provisions->removeElement($provision)) {
            $provision->removeEstablishment($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): static
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setEstablishment($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): static
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getEstablishment() === $this) {
                $employee->setEstablishment(null);
            }
        }

        return $this;
    }

}
