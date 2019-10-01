<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(name="user_id", type="uuid")
     * @ORM\Id
     * @var string
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $password;
    /**
     * @ORM\OneToOne(targetEntity="UserProfile", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * @var UserProfile
     */
    private $profile;
    /**
     * @ORM\OneToMany(targetEntity="PeriodUser", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="owner_id")
     * @var []Period
     */
    private $authorizations;

    public function __construct()
    {
        $this->periods = new ArrayCollection();
        $this->authorizations = new ArrayCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {
    }

    public function getId()
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getProfile(): ?UserProfile
    {
        return $this->profile;
    }

    public function setProfile(?UserProfile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @return Collection|PeriodUser[]
     */
    public function getAuthorizations(): Collection
    {
        return $this->authorizations;
    }

    public function addAuthorization(PeriodUser $authorization): self
    {
        if (!$this->authorizations->contains($authorization)) {
            $this->authorizations[] = $authorization;
            $authorization->setUser($this);
        }

        return $this;
    }

    public function removeAuthorization(PeriodUser $authorization): self
    {
        if ($this->authorizations->contains($authorization)) {
            $this->authorizations->removeElement($authorization);
            // set the owning side to null (unless already changed)
            if ($authorization->getUser() === $this) {
                $authorization->setUser(null);
            }
        }

        return $this;
    }
}
