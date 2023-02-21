<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController extends AbstractController
{
    /**
     * @Route("Clotheshub/homepage", name="homepage")
     */
    public function ShowHomepage(ProductRepository $repo): Response
    {
        $product = $repo->findAll();
        $brand = $repo->findAll();
        return $this->render('homepage/homepage.html.twig', [
            'product' => $product,
            'brand' => $brand
        ]);
    }

    /**
     * @Route("Clotheshub/about", name="homepageAbout")
     */
    public function ShowAbout(): Response
    {
        return $this->render('homepage/about.html.twig', [
            'AboutController' => 'AboutController',
        ]);
    }

    /**
     * @Route("Clotheshub/contact", name="homepageContact")
     */
    public function ShowContact(): Response
    {
        return $this->render('homepage/contact.html.twig', [
            'ContactController' => 'ContactController',
        ]);
    }

      /**
     * @Route("Clotheshub/cart", name="homepageCart")
     */
    public function ShowCart(): Response
    {
        return $this->render('homepage/cart.html.twig', [
            'CartController' => 'CartController',
        ]);
    }

     /**
     * @Route("Clotheshub/product/{id}", name="product_detail", requirements={"id"="\d+"})
     */
    public function productDetail(Product $product): Response
    {
        return $this->render('product/productdetail.html.twig', [
            'product' => $product
        ]);
    }
}
