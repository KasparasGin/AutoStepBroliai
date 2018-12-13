<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplierRepository")
 */
class Supplier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $company_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $accNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Waybill", mappedBy="supplier")
     */
    private $waybills;

    public function __construct()
    {
        $this->waybills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyCode(): ?string
    {
        return $this->company_code;
    }

    public function setCompanyCode(string $company_code): self
    {
        $this->company_code = $company_code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAccNumber(): ?string
    {
        return $this->accNumber;
    }

    public function setAccNumber(string $accNumber): self
    {
        $this->accNumber = $accNumber;

        return $this;
    }

    /**
     * @return Collection|Waybill[]
     */
    public function getWaybills(): Collection
    {
        return $this->waybills;
    }

    public function addWaybill(Waybill $waybill): self
    {
        if (!$this->waybills->contains($waybill)) {
            $this->waybills[] = $waybill;
            $waybill->setSupplier($this);
        }

        return $this;
    }

    public function removeWaybill(Waybill $waybill): self
    {
        if ($this->waybills->contains($waybill)) {
            $this->waybills->removeElement($waybill);
            // set the owning side to null (unless already changed)
            if ($waybill->getSupplier() === $this) {
                $waybill->setSupplier(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->name;
    }
}
