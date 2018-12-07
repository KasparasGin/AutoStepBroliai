<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ToolRepository")
 */
class Tool
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ToolReservation", mappedBy="tool")
     */
    private $toolReservations;

    public function __construct()
    {
        $this->toolReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|ToolReservation[]
     */
    public function getToolReservations(): Collection
    {
        return $this->toolReservations;
    }

    public function addToolReservation(ToolReservation $toolReservation): self
    {
        if (!$this->toolReservations->contains($toolReservation)) {
            $this->toolReservations[] = $toolReservation;
            $toolReservation->setTool($this);
        }

        return $this;
    }

    public function removeToolReservation(ToolReservation $toolReservation): self
    {
        if ($this->toolReservations->contains($toolReservation)) {
            $this->toolReservations->removeElement($toolReservation);
            // set the owning side to null (unless already changed)
            if ($toolReservation->getTool() === $this) {
                $toolReservation->setTool(null);
            }
        }

        return $this;
    }
}
