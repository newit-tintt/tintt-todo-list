<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/purchase", name="purchase")
     */
    public function purchase()
    {
        return $this->render('default/purchase.html.twig');
    }

    /**
     * @Route("/refund", name="refund")
     */
    public function refund()
    {
        return $this->render('default/refund.html.twig');
    }

    /**
     * @Route("/addToCart", name="addToCart")
     */
    public function addToCart()
    {
        return $this->render('default/addToCart.html.twig');
    }

    /**
     * @Route("/offer", name="offer")
     */
    public function offer()
    {
        return $this->render('default/offerViewed.html.twig');
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout()
    {
        return $this->render('default/checkout.html.twig');
    }
}