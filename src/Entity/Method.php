<?php

namespace App\Entity;

use App\Repository\MethodRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MethodRepository::class)]
class Method
{
    use TimestampsTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, MethodDimension>
     */
    #[ORM\OneToMany(targetEntity: MethodDimension::class, mappedBy: 'method')]
    private Collection $methodDimensions;

    public function __construct()
    {
        $this->methodDimensions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, MethodDimension>
     */
    public function getMethodDimensions(): Collection
    {
        return $this->methodDimensions;
    }

    public function addMethodDimension(MethodDimension $methodDimension): static
    {
        if (!$this->methodDimensions->contains($methodDimension)) {
            $this->methodDimensions->add($methodDimension);
            $methodDimension->setMethod($this);
        }

        return $this;
    }

    public function removeMethodDimension(MethodDimension $methodDimension): static
    {
        if ($this->methodDimensions->removeElement($methodDimension)) {
            // set the owning side to null (unless already changed)
            if ($methodDimension->getMethod() === $this) {
                $methodDimension->setMethod(null);
            }
        }

        return $this;
    }
}
