<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class PeriodUser
{
    /**
     * @ORM\Column(name="authorization_id", type="uuid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @var string
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="authorizations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * @var User
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="Period", inversedBy="authorizations")
     * @ORM\JoinColumn(name="period_id", referencedColumnName="period_id")
     * @var User
     */
    private $period;
    /**
     * @ORM\Column(name="is_owner", type="boolean")
     * @var bool
     */
    private $isOwner;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?string
    {
        return (string)$this->id;
    }

    public function getIsOwner(): ?bool
    {
        return $this->isOwner;
    }

    public function setIsOwner(bool $isOwner): self
    {
        $this->isOwner = $isOwner;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }
}
