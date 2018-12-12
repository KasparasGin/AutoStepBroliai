<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;
    /**
         * @ORM\OneToMany(targetEntity="App\Entity\OrderProduct", mappedBy="ProductName")
         */
    private $Ordered;

    public function __construct()
    {
        $this->Ordered = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
    public function getOrdered(): ?Order
    {
        return $this->Ordered;
    }

    public function setOrdered(?Order $Ordered): self
    {
            $this->Ordered = $Ordered;

            return $this;
    }

    public function addOrdered(OrderProduct $ordered): self
    {
            if (!$this->Ordered->contains($ordered)) {
                    $this->Ordered[] = $ordered;
                    $ordered->setProductName($this);
                }

        return $this;
    }

    public function removeOrdered(OrderProduct $ordered): self
    {
            if ($this->Ordered->contains($ordered)) {
                    $this->Ordered->removeElement($ordered);
                    // set the owning side to null (unless already changed)
                    if ($ordered->getProductName() === $this) {
                            $ordered->setProductName(null);
                        }
        }

        return $this;
    }
}
