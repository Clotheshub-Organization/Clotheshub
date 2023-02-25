<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="decimal", precision=10)
     */
    private $productprice;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Brand;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="product")
     */
    private $cartproduct;

    /**
     * @ORM\OneToMany(targetEntity=Orderdetail::class, mappedBy="product")
     */
    private $orderdetails;

    public function __construct()
    {
        $this->orderdetails = new ArrayCollection();
    }
  
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

    /**
     * @return Collection<int, Cart>
     */
    public function getCartproduct(): Collection
    {
        return $this->cartproduct;
    }

    public function addCartproduct(Cart $cartproduct): self
    {
        if (!$this->cartproduct->contains($cartproduct)) {
            $this->cartproduct[] = $cartproduct;
            $cartproduct->setProduct($this);
        }

        return $this;
    }

    public function removeCartproduct(Cart $cartproduct): self
    {
        if ($this->cartproduct->removeElement($cartproduct)) {
            // set the owning side to null (unless already changed)
            if ($cartproduct->getProduct() === $this) {
                $cartproduct->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Orderdetail>
     */
    public function getOrderdetails(): Collection
    {
        return $this->orderdetails;
    }

    public function addOrderdetail(Orderdetail $orderdetail): self
    {
        if (!$this->orderdetails->contains($orderdetail)) {
            $this->orderdetails[] = $orderdetail;
            $orderdetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderdetail(Orderdetail $orderdetail): self
    {
        if ($this->orderdetails->removeElement($orderdetail)) {
            // set the owning side to null (unless already changed)
            if ($orderdetail->getProduct() === $this) {
                $orderdetail->setProduct(null);
            }
        }

        return $this;
    }

}
