<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private ProductRepository $repo;
    public function __construct(ProductRepository $repo)
   {
      $this->repo = $repo;
   }
    // /**
    //  * @Route("Clotheshub/add", name="homepage")
    //  */
    // public function indexPageAction(): Response
    // {
    //     $products = $this->repo->findAll();
    //     return $this->render('/product/form.html.twig', [
    //         'product'=>$products
    //     ]);
    // }
     /**
     * @Route("Clotheshub/admin", name="adminPage")
     */
    public function adminPageAction(): Response{
        return $this->render('admin/admin.html.twig', [
        ]);
    }
}
