<?php

namespace App\Entity;

use App\Repository\UserOrderItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserOrderItemRepository::class)]
class UserOrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userOrderItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserOrder $UserOrder = null;

    #[ORM\Column]
    private ?int $itemPrice = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserOrder(): ?UserOrder
    {
        return $this->UserOrder;
    }

    public function setUserOrder(?UserOrder $UserOrder): static
    {
        $this->UserOrder = $UserOrder;

        return $this;
    }

    public function getItemPrice(): ?int
    {
        return $this->itemPrice;
    }

    public function setItemPrice(int $itemPrice): static
    {
        $this->itemPrice = $itemPrice;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
