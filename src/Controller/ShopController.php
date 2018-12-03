<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop/index", name="shop")
     */
    public function showShop()
    {
        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
    /**
     * @Route("/shop/listShop", name="list")
     */
    public function showList()
    {
        return $this->render('shop/listShop.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
    /**
     * @Route("/shop/orderShop", name="order")
     */
    public function showOrder()
    {
        return $this->render('shop/orderShop.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
    /**
     * @Route("/shop/paymentShop", name="payment")
     */
    public function showPayment()
    {
        return $this->render('shop/paymentShop.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
}
