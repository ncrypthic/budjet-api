<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Period
{
    /**
     * @ORM\Column(name="period_id", type="uuid")
     * @ORM\Id
     * @var string
     */
    private $id;
    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $startDate;
    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $finishDate;
    /**
     * @ORM\OneToMany(targetEntity="PeriodUser", mappedBy="period")
     * @ORM\JoinColumn(name="period_id", referencedColumnName="period_id")
     * @var []User
     */
    private $authorizations;
    /**
     * @ORM\OneToMany(targetEntity="Income", mappedBy="period")
     * @ORM\JoinColumn(name="period_id", referencedColumnName="period_id")
     * @var []Income
     */
    private $income;
    /**
     * @ORM\OneToMany(targetEntity="Budget", mappedBy="period")
     * @ORM\JoinColumn(name="period_id", referencedColumnName="period_id")
     * @var []Budget
     */
    private $budgets;

    public function __construct()
    {
        $this->authorizations = new ArrayCollection();
        $this->income = new ArrayCollection();
        $this->budgets = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getFinishDate(): ?\DateTimeInterface
    {
        return $this->finishDate;
    }

    public function setFinishDate(\DateTimeInterface $finishDate): self
    {
        $this->finishDate = $finishDate;

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
            $authorization->setPeriod($this);
        }

        return $this;
    }

    public function removeAuthorization(PeriodUser $authorization): self
    {
        if ($this->authorizations->contains($authorization)) {
            $this->authorizations->removeElement($authorization);
            // set the owning side to null (unless already changed)
            if ($authorization->getPeriod() === $this) {
                $authorization->setPeriod(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Income[]
     */
    public function getIncome(): Collection
    {
        return $this->income;
    }

    public function addIncome(Income $income): self
    {
        if (!$this->income->contains($income)) {
            $this->income[] = $income;
            $income->setPeriod($this);
        }

        return $this;
    }

    public function removeIncome(Income $income): self
    {
        if ($this->income->contains($income)) {
            $this->income->removeElement($income);
            // set the owning side to null (unless already changed)
            if ($income->getPeriod() === $this) {
                $income->setPeriod(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Budget[]
     */
    public function getBudgets(): Collection
    {
        return $this->budgets;
    }

    public function addBudget(Budget $budget): self
    {
        if (!$this->budgets->contains($budget)) {
            $this->budgets[] = $budget;
            $budget->setPeriod($this);
        }

        return $this;
    }

    public function removeBudget(Budget $budget): self
    {
        if ($this->budgets->contains($budget)) {
            $this->budgets->removeElement($budget);
            // set the owning side to null (unless already changed)
            if ($budget->getPeriod() === $this) {
                $budget->setPeriod(null);
            }
        }

        return $this;
    }
}
