<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\BrandRepository;
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    /**
     * @Route("Clotheshub/AddCart/{id}", name="addCart")
     */
    public function addCart(Request $req, CartRepository $cartRepo, Product $product): Response
    {
        $quantity = $req->query->get('quantity');
        $user = $this->getUser();
        $data[]=[
            'id' => $user->getId()
        ];
        // $userid = $data[0]['id'];
        $cart = $cartRepo->findBy([
            'product'=>$product,
            'user'=>$user
        ]);

        if (count($cart) == 0){
            $c = new Cart();
            $c->setProduct($product);
            $c->setUser($user);
            $c->setQuantity($quantity);
        }

        else {
            $c = $cartRepo->find($cart[0]->getId());
            $oldQuantity = $c->getQuantity();
            $newQuantity = $oldQuantity + $quantity;
            $c = $c->setQuantity($newQuantity);
        }

        $cartRepo->add($c,true);
        return $this->redirectToRoute('showCart', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("Clotheshub/Cart", name="showCart")
     */
    public function showCart(CartRepository $repoCart, BrandRepository $reopBrand): Response
    {
        $user = $this->getUser();
        $data[]=[
            'id' => $user->getId()
        ];
        $userid = $data[0]['id'];
        $product = $repoCart->showCart($userid);
        $total = 0;
        foreach ($product as $p){
            $total += $p['total'];
        }
        $brand = $reopBrand->findAll();
        // return $this->json($product);
        return $this->render('cart/cart.html.twig', [
            'product' => $product,
            'brand' => $brand,
            'total' => $total
        ]);
    }
}