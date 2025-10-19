<?php

namespace App\Entity;

use App\Repository\AnswersRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
 

#[ORM\Entity(repositoryClass: AnswersRepository::class)]
class Answers
{
    use TimestampsTrait;

    public function __construct()
    {
        $this->sessionsAnswers = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    

    #[ORM\ManyToOne(inversedBy: 'answers')]
    private ?Questions $question = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    private ?MethodDimension $method_dimension = null;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private ?int $method_dimension_value = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $content = null;

    

    /**
     * @var Collection<int, SessionsAnswers>
     */
    #[ORM\OneToMany(targetEntity: SessionsAnswers::class, mappedBy: 'answer')]
    private Collection $sessionsAnswers;

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getQuestion(): ?Questions
    {
        return $this->question;
    }

    public function setQuestion(?Questions $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getMethodDimension(): ?MethodDimension
    {
        return $this->method_dimension;
    }

    public function setMethodDimension(?MethodDimension $method_dimension): static
    {
        $this->method_dimension = $method_dimension;

        return $this;
    }

    public function getMethodDimensionValue(): ?int
    {
        return $this->method_dimension_value;
    }

    public function setMethodDimensionValue(?int $method_dimension_value): static
    {
        $this->method_dimension_value = $method_dimension_value;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    

    /**
     * @return Collection<int, SessionsAnswers>
     */
    public function getSessionsAnswers(): Collection
    {
        return $this->sessionsAnswers;
    }

    public function addSessionsAnswer(SessionsAnswers $sessionsAnswer): static
    {
        if (!$this->sessionsAnswers->contains($sessionsAnswer)) {
            $this->sessionsAnswers->add($sessionsAnswer);
            $sessionsAnswer->setAnswer($this);
        }

        return $this;
    }

    public function removeSessionsAnswer(SessionsAnswers $sessionsAnswer): static
    {
        if ($this->sessionsAnswers->removeElement($sessionsAnswer)) {
            if ($sessionsAnswer->getAnswer() === $this) {
                $sessionsAnswer->setAnswer(null);
            }
        }

        return $this;
    }
}
