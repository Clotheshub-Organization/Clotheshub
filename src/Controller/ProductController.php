<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\BrandRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductController extends AbstractController
{
    private ProductRepository $repo;
    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("Clotheshub/product", name="product_show")
     */
    public function showAllProduct(): Response
    {
        $product = $this->repo->findAll();
        return $this->render('product/product.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("Clotheshub/product/{id}", name="product_detail", requirements={"id"="\d+"})
     */
    public function productDetail(Product $product, ProductRepository $productRepo): Response
    {
        return $this->render('product/productdetail.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("Clotheshub/product/manage", name="product_manage")
     */
    public function showProduct(): Response
    {
        $product = $this->repo->findAll();
        return $this->render('product/manage.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("Clotheshub/product/manage/add", name="product_create")
     */
    public function createAction(Request $req, SluggerInterface $slugger): Response
    {

        $p = new Product();
        $form = $this->createForm(ProductType::class, $p);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile, $slugger);
                $p->setImage($newFilename);
            }
            $this->repo->add($p, true);
            return $this->redirectToRoute('product_manage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("product/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("Clotheshub/product/manage/edit/{id}", name="product_edit",requirements={"id"="\d+"})
     */
    public function editAction(
        Request $req,
        Product $p,
        SluggerInterface $slugger
    ): Response {

        $form = $this->createForm(ProductType::class, $p);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile, $slugger);
                $p->setImage($newFilename);
            }
            $this->repo->add($p, true);
            return $this->redirectToRoute('product_manage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("product/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    public function uploadImage($imgFile, SluggerInterface $slugger): ?string
    {
        $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $imgFile->guessExtension();
        try {
            $imgFile->move(
                $this->getParameter('image_dir'),
                $newFilename
            );
        } catch (FileException $e) {
            echo $e;
        }
        return $newFilename;
    }

    /**
     * @Route("Clotheshub/product/manage/delete/{id}",name="product_delete",requirements={"id"="\d+"})
     */

    public function deleteProductAction(Request $request, Product $p): Response
    {
        $this->repo->remove($p, true);
        return $this->redirectToRoute('product_manage', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("Clotheshub/search", name="search", methods="GET")
     */
    public function searchProduct(ProductRepository $repo, Request $req): Response
    {
        $search=$req->query->get("search");
        $product = $repo->findByProductName($search);
        return $this->render('search/product.html.twig', [
            'product' => $product,
            'search' => $search
        ]);
    }




    //  /**
    //  * @Route("/add", name="product_create")
    //  */
    // public function createAction(Request $req, SluggerInterface $slugger): Response
    // {

    //     $p = new Product();
    //     $form = $this->createForm(ProductType::class, $p);

    //     $form->handleRequest($req);
    //     if($form->isSubmitted() && $form->isValid()){
    //         if($p->getCreated()===null){
    //             $p->setCreated(new \DateTime());
    //         }
    //         $imgFile = $form->get('file')->getData();
    //         if ($imgFile) {
    //             $newFilename = $this->uploadImage($imgFile,$slugger);
    //             $p->setImage($newFilename);
    //         }
    //         $this->repo->save($p,true);
    //         return $this->redirectToRoute('product_show', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->render("product/form.html.twig",[
    //         'form' => $form->createView()
    //     ]);
    // }

    //  /**
    //  * @Route("/edit/{id}", name="product_edit",requirements={"id"="\d+"})
    //  */
    // public function editAction(Request $req, Product $p,
    // SluggerInterface $slugger): Response
    // {

    //     $form = $this->createForm(ProductType::class, $p);   

    //     $form->handleRequest($req);
    //     if($form->isSubmitted() && $form->isValid()){

    //         if($p->getCreated()===null){
    //             $p->setCreated(new \DateTime());
    //         }
    //         $imgFile = $form->get('file')->getData();
    //         if ($imgFile) {
    //             $newFilename = $this->uploadImage($imgFile,$slugger);
    //             $p->setImage($newFilename);
    //         }
    //         $this->repo->save($p,true);
    //         return $this->redirectToRoute('product_show', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->render("product/form.html.twig",[
    //         'form' => $form->createView()
    //     ]);
    // }

    // public function uploadImage($imgFile, SluggerInterface $slugger): ?string{
    //     $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
    //     $safeFilename = $slugger->slug($originalFilename);
    //     $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();
    //     try {
    //         $imgFile->move(
    //             $this->getParameter('image_dir'),
    //             $newFilename
    //         );
    //     } catch (FileException $e) {
    //         echo $e;
    //     }
    //     return $newFilename;
    // }
}
