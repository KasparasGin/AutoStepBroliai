<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
