<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkRepository")
 */
class Work
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     */
    private $timeNeeded;

    /**
     * @ORM\Column(type="boolean")
     */
    private $completion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visit", inversedBy="works")
     */
    private $visit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TimeTable", inversedBy="works")
     */
    private $timeTable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Added;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTimeNeeded(): ?int
    {
        return $this->timeNeeded;
    }

    public function setTimeNeeded(int $timeNeeded): self
    {
        $this->timeNeeded = $timeNeeded;

        return $this;
    }

    public function getCompletion(): ?bool
    {
        return $this->completion;
    }

    public function setCompletion(bool $completion): self
    {
        $this->completion = $completion;

        return $this;
    }

    public function getVisit(): ?Visit
    {
        return $this->visit;
    }

    public function setVisit(?Visit $visit): self
    {
        $this->visit = $visit;

        return $this;
    }

    public function getTimeTable(): ?TimeTable
    {
        return $this->timeTable;
    }

    public function setTimeTable(?TimeTable $timeTable): self
    {
        $this->timeTable = $timeTable;

        return $this;
    }

    public function getAdded(): ?bool
    {
        return $this->Added;
    }

    public function setAdded(bool $Added): self
    {
        $this->Added = $Added;

        return $this;
    }
}
