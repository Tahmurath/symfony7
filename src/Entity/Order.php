<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $orderTitle = null;

    #[ORM\Column]
    private ?int $orderPrice = null;

    #[ORM\Column(length: 255)]
    private ?string $OrderStatus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderTitle(): ?string
    {
        return $this->orderTitle;
    }

    public function setOrderTitle(string $orderTitle): static
    {
        $this->orderTitle = $orderTitle;

        return $this;
    }

    public function getOrderPrice(): ?int
    {
        return $this->orderPrice;
    }

    public function setOrderPrice(int $orderPrice): static
    {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    public function getOrderStatus(): ?string
    {
        return $this->OrderStatus;
    }

    public function setOrderStatus(string $OrderStatus): static
    {
        $this->OrderStatus = $OrderStatus;

        return $this;
    }
}
