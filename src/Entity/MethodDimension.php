<?php

namespace App\Entity;

use App\Repository\MethodDimensionRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MethodDimensionRepository::class)]
class MethodDimension
{
    use TimestampsTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'methodDimensions')]
    private ?Method $method = null;

    /**
     * @var Collection<int, Answers>
     */
    #[ORM\OneToMany(targetEntity: Answers::class, mappedBy: 'method_dimension')]
    private Collection $answers;

    

    public function __construct()
    {
        $this->answers = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getMethod(): ?Method
    {
        return $this->method;
    }

    public function setMethod(?Method $method): static
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return Collection<int, Answers>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answers $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setMethodDimension($this);
        }

        return $this;
    }

    public function removeAnswer(Answers $answer): static
    {
        if ($this->answers->removeElement($answer)) {
            if ($answer->getMethodDimension() === $this) {
                $answer->setMethodDimension(null);
            }
        }

        return $this;
    }
}
