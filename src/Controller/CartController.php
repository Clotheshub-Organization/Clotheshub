<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\Orderdetail;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\BrandRepository;
use App\Repository\CartRepository;
use App\Repository\OrderdetailRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("Clotheshub/cart/delete/{product}",name="deleteCart", requirements={"product"="\d+"})
     */

    public function deleteCart(CartRepository $repo, Cart $cart): Response
    {
        $repo->remove($cart, true);
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
        $products = $repoCart->showCart($userid);

        $total = 0;
        foreach ($products as $p) {
            $total += $p['total'];
        }

        // return $this->json($total);
        return $this->render('cart/cart.html.twig', [
            'products' => $products,
            'total' => $total
        ]);
    }

    /**
     * @Route("Clotheshub/order/{user}", name="add_order", requirements={"user"="\d+"})
     */
    public function showOrder(OrderRepository $orderRepo, CartRepository $cartRepo, OrderdetailRepository $detailRepo, ProductRepository $productRepo, EntityManagerInterface $en): Response
    {
        // insert into order table
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

        $total = 0;
        foreach ($product as $p) {
            $total += $p['total'];
        }
        $order->setTotal($total);
        $order->setDate(new \DateTime());
        // insert into order table after has enought data
        $orderRepo->add($order, true);

        //insert into order detail table
        $orderid = $orderRepo->orderdetail($userid)[0]['id'];
        $orderobject = $orderRepo->find($orderid);

        // $cart_userid = $cartRepo->findcart($id);

        foreach ($product as $p) {
            $orderdetail = new Orderdetail();
            $product = $p['id'];
            $productobject = $productRepo->find($product);
            $quantity = $p['quantity'];
            $orderdetail->setOrders($orderobject);
            $orderdetail->setProduct($productobject);
            $orderdetail->setQuantity($quantity);
            // insert into order detial table after has enought data
            $detailRepo->add($orderdetail, true);
        }

        // delete cart after checkout
        $deletecart = $cartRepo->findAll();
        foreach ($deletecart as $delcart) {
            $en->remove($delcart);
        }
        $en->flush();

        // show order and order detail
        // $orderdetailtemplate = $detailRepo->showOrderdetail($orderid);
        // $ordertemplate = $orderRepo->userOrder();
        // $brand = $brandRepo->findAll();

        return $this->redirectToRoute('orderConfirm', [], Response::HTTP_SEE_OTHER);

        // show order confirmation
        // return $this->render('order/orderconfirm.html.twig', [
        //     'order' => $ordertemplate,
        //     'orderdetail' => $orderdetailtemplate,
        //     'brand' => $brand,
        //     'total' => $total
        // ]);
    }


    /**
     * @Route("Clotheshub/order/confirm", name="orderConfirm")
     */
    public function orderDetail(UserRepository $userRepo, CartRepository $cartRepo, BrandRepository $brandRepo, OrderRepository $orderRepo, OrderdetailRepository $detailRepo): Response
    {
        $user = $this->getUser();
        $data[] = [
            'id' => $user->getId()
        ];
        $userid = $data[0]['id'];

        $orderid = $orderRepo->orderdetail($userid)[0]['id'];

        $product = $cartRepo->findCart($userid);

        $total = 0;
        foreach ($product as $p) {
            $total += $p['total'];
        }

        // show order and order detail
        $orderdetailtemplate = $detailRepo->showOrderdetail($orderid);
        $ordertemplate = $orderRepo->userOrder();

        $userdata = $userRepo->userData($userid);

        // show order confirmation
        return $this->render('order/orderconfirm.html.twig', [
            'order' => $ordertemplate,
            'orderdetail' => $orderdetailtemplate,
            'userdata' => $userdata,
            'total' => $total
        ]);
    }
}
