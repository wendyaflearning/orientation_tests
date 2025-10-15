<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    use TimestampsTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $order_index = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?MethodDimension $method_dimension = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Tests $test = null;

    #[ORM\OneToOne(mappedBy: 'question', cascade: ['persist', 'remove'])]
    private ?Answers $answers = null;

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

    public function getOrderIndex(): ?int
    {
        return $this->order_index;
    }

    public function setOrderIndex(int $order_index): static
    {
        $this->order_index = $order_index;

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

    public function getTest(): ?Tests
    {
        return $this->test;
    }

    public function setTest(?Tests $test): static
    {
        $this->test = $test;

        return $this;
    }

    public function getAnswers(): ?Answers
    {
        return $this->answers;
    }

    public function setAnswers(?Answers $answers): static
    {
        // unset the owning side of the relation if necessary
        if ($answers === null && $this->answers !== null) {
            $this->answers->setQuestion(null);
        }

        // set the owning side of the relation if necessary
        if ($answers !== null && $answers->getQuestion() !== $this) {
            $answers->setQuestion($this);
        }

        $this->answers = $answers;

        return $this;
    }
}
