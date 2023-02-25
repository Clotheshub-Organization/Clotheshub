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
     * @Route("Clotheshub/cart/add/{id}", name="addCart")
     */
    public function addCart(Request $req, CartRepository $cartRepo, Product $product): Response
    {
        $quantity = $req->query->get('quantity');
        $user = $this->getUser();
        $data[] = [
            'id' => $user->getId()
        ];
        // $userid = $data[0]['id'];
        $cart = $cartRepo->findBy([
            'product' => $product,
            'user' => $user
        ]);

        if (count($cart) == 0) {
            $c = new Cart();
            $c->setProduct($product);
            $c->setUser($user);
            $c->setQuantity($quantity);
        } else {
            $c = $cartRepo->find($cart[0]->getId());
            $oldQuantity = $c->getQuantity();
            $newQuantity = $oldQuantity + $quantity;
            $c = $c->setQuantity($newQuantity);
        }

        $cartRepo->add($c, true);
        return $this->redirectToRoute('showCart', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("Clotheshub/Cart", name="showCart")
     */
    public function showCart(CartRepository $repoCart, BrandRepository $reopBrand): Response
    {
        $user = $this->getUser();
        $data[] = [
            'id' => $user->getId()
        ];
        $userid = $data[0]['id'];
        $product = $repoCart->showCart($userid);
        $total = 0;
        foreach ($product as $p) {
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

    /**
     * @Route("Clotheshub/cart/delete/{product}",name="deleteCart", requirements={"product"="\d+"})
     */

    public function deleteBrandAction(CartRepository $repo, Cart $cart): Response
    {
        $repo->remove($cart, true);
        return $this->redirectToRoute('showCart', [], Response::HTTP_SEE_OTHER);
    }

     /**
     * @Route("Clotheshub/order/{user}", name="show_order", requirements={"id"="\d+"})
     */
    public function showOrder(OrderRepository $orderRepo, CartRepository $cartRepo, OrderdetailRepository $detailRepo, BrandRepository $brandRepo, ProductRepository $productRepo, EntityManagerInterface $en): Response
    {
        // insert into order table
        $brand = $brandRepo->findAll();
        $order = new Order();
        // get user id
        $user = $this->getUser();
        $data[] = [
            'id' => $user->getId()
        ];
        $userid = $data[0]['id'];

        // set user id to order table
        $order->setUser($user);

        // get product id and quantity from cart
        $product = $cartRepo->findCart($userid);

        $total =0;
        foreach($product as $p){
            $total += $p['total'];
        }
        $order->setTotal($total);
        $order->setDate(new \DateTime());
        $orderRepo->add($order, true);

        return $this->render('order/order.html.twig', [
        ]);
    }


}
