<?php

namespace App\Entity;

use App\Enums\Users\UsersStatusEnum;
use App\Repository\UsersRepository;
use App\Traits\Timestamps\TimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampsTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(enumType: UsersStatusEnum::class)]
    private ?UsersStatusEnum $status = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    /**
     * @var array<string>
     */
    #[ORM\Column(type: 'json', options: ['default' => '["ROLE_USER"]'])]
    private array $roles = ['ROLE_USER'];

    /**
     * @var Collection<int, Sessions>
     */
    #[ORM\OneToMany(targetEntity: Sessions::class, mappedBy: 'candidate')]
    private Collection $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getStatus(): ?UsersStatusEnum
    {
        return $this->status;
    }

    public function setStatus(UsersStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Sessions>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Sessions $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setCandidate($this);
        }

        return $this;
    }

    public function removeSession(Sessions $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getCandidate() === $this) {
                $session->setCandidate(null);
            }
        }

        return $this;
    }

    // Méthodes de UserInterface

    /**
     * Retourne l'identifiant unique de l'utilisateur (ici l'email)
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return array<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // Garantit que chaque utilisateur a au moins ROLE_USER
        if (!in_array('ROLE_USER', $roles, true)) {
            $roles[] = 'ROLE_USER';
        }

        return $roles;
    }

    /**
     * @param array<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Méthode de PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Méthode pour effacer les données sensibles temporaires
     * (utilisée par Symfony après l'authentification)
     */
    public function eraseCredentials(): void
    {
        // Si vous stockez des données temporaires sensibles, effacez-les ici
        // Par exemple : $this->plainPassword = null;
    }
}
