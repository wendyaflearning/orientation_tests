<?php

namespace App\Entity;

use App\Repository\FeedbacksRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeedbacksRepository::class)]
class Feedbacks
{
    use TimestampsTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Users $candidate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Sessions $session = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private array $structured_data = [];

    #[ORM\Column(length: 255)]
    private ?string $llm_model = null;

    #[ORM\Column(nullable: true)]
    private ?int $tokens_consumed = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $generated_at = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSession(): ?Sessions
    {
        return $this->session;
    }

    public function setSession(?Sessions $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getStructuredData(): array
    {
        return $this->structured_data;
    }

    public function setStructuredData(array $structured_data): static
    {
        $this->structured_data = $structured_data;

        return $this;
    }

    public function getLlmModel(): ?string
    {
        return $this->llm_model;
    }

    public function setLlmModel(string $llm_model): static
    {
        $this->llm_model = $llm_model;

        return $this;
    }

    public function getTokensConsumed(): ?int
    {
        return $this->tokens_consumed;
    }

    public function setTokensConsumed(?int $tokens_consumed): static
    {
        $this->tokens_consumed = $tokens_consumed;

        return $this;
    }

    public function getGeneratedAt(): ?\DateTimeImmutable
    {
        return $this->generated_at;
    }

    public function setGeneratedAt(?\DateTimeImmutable $generated_at): static
    {
        $this->generated_at = $generated_at;

        return $this;
    }
}
