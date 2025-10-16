<?php

namespace App\Entity;

use App\Repository\SessionsAnswersRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;
 

#[ORM\Entity(repositoryClass: SessionsAnswersRepository::class)]
class SessionsAnswers
{
    use TimestampsTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sessionsAnswers')]
    private ?Answers $answer = null;

    #[ORM\ManyToOne]
    private ?Sessions $session = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?Answers
    {
        return $this->answer;
    }

    public function setAnswer(?Answers $answer): static
    {
        $this->answer = $answer;

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


