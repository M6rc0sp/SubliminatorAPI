<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: "orders_table")]
class Order
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $customer = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $address1 = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $city = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $postcode = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $country = null;

    #[ORM\Column(type: "float")]
    private ?float $amount = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $deleted = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $last_modified = null;

     // getters and setters...
     public function getId(): ?int
     {
         return $this->id;
     }
 
     public function setId(int $id): self
     {
         $this->id = $id;
 
         return $this;
     }
 
     public function getDate(): ?\DateTimeInterface
     {
         return $this->date;
     }
 
     public function setDate(\DateTimeInterface $date): self
     {
         $this->date = $date;
 
         return $this;
     }
 
     public function getCustomer(): ?string
     {
         return $this->customer;
     }
 
     public function setCustomer(string $customer): self
     {
         $this->customer = $customer;
 
         return $this;
     }
 
     public function getAddress1(): ?string
     {
         return $this->address1;
     }
 
     public function setAddress1(string $address1): self
     {
         $this->address1 = $address1;
 
         return $this;
     }
 
     public function getCity(): ?string
     {
         return $this->city;
     }
 
     public function setCity(string $city): self
     {
         $this->city = $city;
 
         return $this;
     }
 
     public function getPostcode(): ?string
     {
         return $this->postcode;
     }
 
     public function setPostcode(string $postcode): self
     {
         $this->postcode = $postcode;
 
         return $this;
     }
 
     public function getCountry(): ?string
     {
         return $this->country;
     }
 
     public function setCountry(string $country): self
     {
         $this->country = $country;
 
         return $this;
     }
 
     public function getAmount(): ?float
     {
         return $this->amount;
     }
 
     public function setAmount(float $amount): self
     {
         $this->amount = $amount;
 
         return $this;
     }
 
     public function getStatus(): ?string
     {
         return $this->status;
     }
 
     public function setStatus(string $status): self
     {
         $this->status = $status;
 
         return $this;
     }
 
     public function getDeleted(): ?string
     {
         return $this->deleted;
     }
 
     public function setDeleted(string $deleted): self
     {
         $this->deleted = $deleted;
 
         return $this;
     }
 
     public function getLastModified(): ?\DateTimeInterface
     {
         return $this->last_modified;
     }
 
     public function setLastModified(\DateTimeInterface $last_modified): self
     {
         $this->last_modified = $last_modified;
 
         return $this;
     }
}