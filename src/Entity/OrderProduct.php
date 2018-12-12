<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderProductRepository")
 */
class OrderProduct
{
        /**
         * @ORM\Id()
         * @ORM\GeneratedValue()
         * @ORM\Column(type="integer")
         */
        private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="Ordered")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ProductName;

    /**
     * @ORM\Column(type="integer")
     */
    private $Amount;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orders", inversedBy="OrderProduct")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IsInOrder;

   public function getId(): ?int
    {
                return $this->id;
    }

    public function getProductName(): ?Product
    {
                return $this->ProductName;
    }

    public function setProductName(?Product $ProductName): self
    {
               $this->ProductName = $ProductName;

                return $this;
    }

    public function getAmount(): ?int
    {
                return $this->Amount;
    }

    public function setAmount(int $Amount): self
    {
                $this->Amount = $Amount;

                return $this;
    }

    public function getIsInOrder(): ?Orders
   {
                return $this->IsInOrder;
    }

    public function setIsInOrder(?Orders $IsInOrder): self
    {
                $this->IsInOrder = $IsInOrder;

                return $this;
    }
}