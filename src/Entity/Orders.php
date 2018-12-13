<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
        /**
         * @ORM\Id()
         * @ORM\GeneratedValue()
         * @ORM\Column(type="integer")
         */
        private $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Orders")
     * @ORM\JoinColumn(nullable=false)
    */
    private $user;

    public function __construct()
    {
                $this->OrderProduct = new ArrayCollection();
            }

    public function getId(): ?int
    {
                return $this->id;
    }

   public function removeOrderProduct(OrderProduct $orderProduct): self
    {
                if ($this->OrderProduct->contains($orderProduct)) {
                        $this->OrderProduct->removeElement($orderProduct);
                        // set the owning side to null (unless already changed)
                        if ($orderProduct->getIsInOrder() === $this) {
                                $orderProduct->setIsInOrder(null);
                            }
        }

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
}