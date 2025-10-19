<?php

namespace App\Entity;

use App\Repository\ScoresRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoresRepository::class)]
class Scores
{
    use TimestampsTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $value = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MethodDimension $methodDimension = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sessions $session = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getMethodDimension(): ?MethodDimension
    {
        return $this->methodDimension;
    }

    public function setMethodDimension(MethodDimension $methodDimension): static
    {
        $this->methodDimension = $methodDimension;

        return $this;
    }

    public function getSession(): ?Sessions
    {
        return $this->session;
    }

    public function setSession(?Sessions $session): static
    {
        $this->session = $session;

        return $this;
    }
}
