<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Expense
{
    /**
     * @ORM\Column(name="expense_id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @var string
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Budget", inversedBy="expenses")
     * @ORM\JoinColumn(name="budget_id", referencedColumnName="budget_id")
     * @var Budget
     */
    private $budget;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $description;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $currency;
    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @var float
     */
    private $amount;
    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $trxDate;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?string
    {
        return (string)$this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTrxDate(): ?\DateTimeInterface
    {
        return $this->trxDate;
    }

    public function setTrxDate(\DateTimeInterface $trxDate): self
    {
        $this->trxDate = $trxDate;

        return $this;
    }

    public function getBudget(): ?Budget
    {
        return $this->budget;
    }

    public function setBudget(?Budget $budget): self
    {
        $this->budget = $budget;

        return $this;
    }
}
