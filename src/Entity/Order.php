<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints as Assert;

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

    #[ORM\Column]
    #[Assert\NotNull]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s'])]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->setUpdatedAt(new \DateTimeImmutable());
    }

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
