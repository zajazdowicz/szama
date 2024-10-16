<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $street = null;

    #[ORM\Column(length: 62, nullable: true)]
    private ?string $streetNumber = null;

    #[ORM\OneToOne(mappedBy: 'address', cascade: ['persist', 'remove'])]
    private ?RestaurantDetails $restaurantDetails = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(?string $streetNumber): static
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getRestaurantDetails(): ?RestaurantDetails
    {
        return $this->restaurantDetails;
    }

    public function setRestaurantDetails(?RestaurantDetails $restaurantDetails): static
    {
        // unset the owning side of the relation if necessary
        if ($restaurantDetails === null && $this->restaurantDetails !== null) {
            $this->restaurantDetails->setAddress(null);
        }

        // set the owning side of the relation if necessary
        if ($restaurantDetails !== null && $restaurantDetails->getAddress() !== $this) {
            $restaurantDetails->setAddress($this);
        }

        $this->restaurantDetails = $restaurantDetails;

        return $this;
    }
}
