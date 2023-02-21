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
    public function ShowHomepage(): Response
    {
        return $this->render('homepage/homepage.html.twig', [
        ]);
    }
}
