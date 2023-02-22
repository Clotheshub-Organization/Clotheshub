<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Proxies\__CG__\App\Entity\Brand;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $productdes;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $productprice;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Brand;

    public function getId()
    {
        return $this->id;
    }

    public function getProductname(): ?string
    {
        return $this->productname;
    }

    public function setProductname(string $productname): self
    {
        $this->productname = $productname;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getProductdes(): ?string
    {
        return $this->productdes;
    }

    public function setProductdes(?string $productdes): self
    {
        $this->productdes = $productdes;

        return $this;
    }

    public function getProductprice(): ?string
    {
        return $this->productprice;
    }

    public function setProductprice(string $productprice): self
    {
        $this->productprice = $productprice;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->Brand;
    }

    public function setBrand(?Brand $Brand): self
    {
        $this->Brand = $Brand;

        return $this;
    }

}
