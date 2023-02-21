<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class BrandController extends AbstractController
{
    private BrandRepository $repo;
    public function __construct(BrandRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("Clotheshub/brand/manage", name="brand_manage")
     */
    public function showBrand(): Response
    {
        $brand = $this->repo->findAll();
        return $this->render('brand/manage.html.twig', [
            'brand' => $brand
        ]);
    }

    /**
     * @Route("Clotheshub/brand/add", name="brand_create")
     */
    public function createBrandAction(Request $req, SluggerInterface $slugger): Response
    {
        $b = new Brand();
        $form = $this->createForm(BrandType::class, $b);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->add($b, true);
            return $this->redirectToRoute('brand_manage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("brand/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("Clotheshub/brand/edit/{id}", name="brand_edit", requirements={"id"="\d+"})
     */
    public function editBrandAction(
        Request $req,
        Brand $b,
        SluggerInterface $slugger
    ): Response {

        $form = $this->createForm(BrandType::class, $b);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->add($b, true);
            return $this->redirectToRoute('brand_manage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("brand/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("Clotheshub/brand/delete/{id}",name="brand_delete", requirements={"id"="\d+"})
     */

    public function deleteBrandAction(Request $request, Brand $b): Response
    {
        $this->repo->remove($b, true);
        return $this->redirectToRoute('brand_manage', [], Response::HTTP_SEE_OTHER);
    }
}
