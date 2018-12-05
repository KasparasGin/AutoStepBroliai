<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductAdd;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop/listShop", name="products")
     */
    public function showShopMenu(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $products = $em->getRepository('App:Product')->findAll();
        /*if(in_array('ROLE_ADMIN', $user->getRoles()) ||
            in_array('ROLE_MECHANIC', $user->getRoles()))
            $suppliers = $em->getRepository('App:Supplier')->findAll();

        else {
            $suppliers = $em->getRepository('App:Supplier')
                ->findBy(
                    ['user' => $user->getId()]
                );
        }*/
        return $this->render('shop/listShop.html.twig', [
            'products' => $products,
        ]);
    }
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
    /**
     * @Route("/shop/orderedShop", name="ordered")
     */
    public function showOrders()
    {
        return $this->render('shop/orderedShop.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
    /**
     * @Route("/shop/ordereditShop", name="orderedit")
     */
    public function showOrderEdit()
    {
        return $this->render('shop/ordereditShop.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
    /**
     * @Route("/shop/orderdeleteShop", name="orderdelete")
     */
    public function showOrderDelete()
    {
        return $this->render('shop/orderdeleteShop.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
    /**
     * @Route("/shop/orderShop", name="order")
     */
    public function orderShop(Request $request)
    {
        $product = new Product();

        $form = $this->createForm(ProductAdd::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $product->setCode($form['code']->getData());
            $product->setName($form['name']->getData());
            $product->setPrice($form['price']->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('shop');
        }
        return $this->render('shop/orderShop.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
