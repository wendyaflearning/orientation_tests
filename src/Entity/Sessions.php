<?php

namespace App\Entity;

use App\Enums\Sessions\SessionsStatusEnum;
use App\Repository\SessionsRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Sessions
{
    use TimestampsTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: SessionsStatusEnum::class)]
    private ?SessionsStatusEnum $status = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?Tests $test = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?Users $candidate = null;

    /**
     * @var Collection<int, Scores>
     */
    #[ORM\OneToMany(targetEntity: Scores::class, mappedBy: 'session')]
    private Collection $scores;

    

    public function __construct()
    {
        $this->scores = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?SessionsStatusEnum
    {
        return $this->status;
    }

    public function setStatus(SessionsStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTest(): ?Tests
    {
        return $this->test;
    }

    public function setTest(?Tests $test): static
    {
        $this->test = $test;

        return $this;
    }

    public function getCandidate(): ?Users
    {
        return $this->candidate;
    }

    public function setCandidate(?Users $candidate): static
    {
        $this->candidate = $candidate;

        return $this;
    }

    /**
     * @return Collection<int, Scores>
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Scores $score): static
    {
        if (!$this->scores->contains($score)) {
            $this->scores->add($score);
            $score->setSession($this);
        }

        return $this;
    }

    public function removeScore(Scores $score): static
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getSession() === $this) {
                $score->setSession(null);
            }
        }

        return $this;
    }

    /**
     * Retourne les scores de la session au format JSON
     * Exemple: ["R" => 2, "I" => 7, "A" => 4, "S" => 0, "E" => 0, "C" => 2]
     */
    public function getScoresAsJson(): array
    {
        $result = [];
        foreach ($this->scores as $score) {
            $dimension = $score->getMethodDimension();
            if ($dimension) {
                $result[$dimension->getCode()] = $score->getValue();
            }
        }
        return $result;
    }

    
}
