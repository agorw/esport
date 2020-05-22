<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Constraints as AppAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="E-mail déja utilisé !")
 * @UniqueEntity(fields={"pseudo"}, message="Pseudo déja utilisé !")
 * @UniqueEntity(fields={"telephone"}, message="Numéro de téléphone déja utilisé !")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "Le pseudo doit être plus grand que {{ limit }} caractères",
     *      maxMessage = "Le pseudo doit être plus petit que {{ limit }} caractères",
     *      allowEmptyString = false
     * )
     */
    private $pseudo;

    /**
     * @var string
     * @ORM\Column(name="telephone", type="string", length=35)
     * @Assert\NotBlank()
     * @AppAssert\Telephone()
     */

    private $telephone;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_create;

    /**
     * @ORM\OneToOne(targetEntity=Profil::class, cascade={"persist", "remove"}, inversedBy="user")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profil;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Badge", mappedBy="users")
     */
    private $badges;

    /**
     * @ORM\OneToMany(targetEntity=TicketAgenda::class, mappedBy="user", orphanRemoval=true)
     */
    private $ticketAgendas;


    public function __construct()
    {
        $this->profil = new Profil;
        $this->date_create = new \DateTime('now');
        $this->badges = new ArrayCollection();
        $this->ticketAgendas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    public function setDateCreate(?\DateTimeInterface $date_create): self
    {
        $this->date_create = $date_create;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * @return Collection|Badge[]
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badge $badge): self
    {
        if (!$this->badges->contains($badge)) {
            $this->badges[] = $badge;
            $badge->addUser($this);
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        if ($this->badges->contains($badge)) {
            $this->badges->removeElement($badge);
            $badge->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|TicketAgenda[]
     */
    public function getTicketAgendas(): Collection
    {
        return $this->ticketAgendas;
    }

    public function addTicketAgenda(TicketAgenda $ticketAgenda): self
    {
        if (!$this->ticketAgendas->contains($ticketAgenda)) {
            $this->ticketAgendas[] = $ticketAgenda;
            $ticketAgenda->setUser($this);
        }

        return $this;
    }

    public function removeTicketAgenda(TicketAgenda $ticketAgenda): self
    {
        if ($this->ticketAgendas->contains($ticketAgenda)) {
            $this->ticketAgendas->removeElement($ticketAgenda);
            // set the owning side to null (unless already changed)
            if ($ticketAgenda->getUser() === $this) {
                $ticketAgenda->setUser(null);
            }
        }

        return $this;
    }
}
