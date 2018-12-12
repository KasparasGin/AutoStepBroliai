<?php

namespace App\Controller;

use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Entity\Orders;
use App\Form\ProductAdd;
use App\Form\OrderAdd;
use App\Form\OrderEditType;
use App\Form\OrderEdit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop/index", name="products")
     */
    public function showShopMenu(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $products = $em->getRepository('App:Product')->findAll();

        return $this->render('shop/index.html.twig', [
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
     * @Route("/shop/index", name="list")
     */
    public function showList()
    {
        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
    /**
     * @Route("/shop/orderedShop", name="orderedShop")
     */
    public function showOrder()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $userid = $user->getId();
        $oproductid = $em->getRepository('App:Orders')->findBy(array('user' => $user),array());
        $product = $em->getRepository('App:OrderProduct')->findBy(array('IsInOrder' => $oproductid),array());

        return $this->render('shop/orderedShop.html.twig', [
            'controller_name' => 'ShopController',
            'products' => $product,
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
     * @Route("/shop/orderShop", name="addProduct")
     */
    public function addProduct(Request $request)
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

    /**
     * @Route("/shop/index/{id}", name="addOrder")
     */
    public function addOrder(Request $request, Product $product)
    {
        $orderproduct = new OrderProduct();
        $order = new Orders();

        $user = $this->getUser();

        $order->setUser($user);

        $orderproduct->setProductName($product);
        $orderproduct->setAmount(10);
        $orderproduct->setIsInOrder($order);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($order);
        $entityManager->flush();

        $entityManager->persist($orderproduct);
        $entityManager->flush();

        return $this->redirectToRoute('shop');

    }
    /**
     * @Route("/shop/ordereditShop/{id}", name="editProduct")
     */
    public function editProduct(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(OrderEditType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('shop');
        }
        return $this->render('shop/ordereditShop.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/shop/orderdelete/{id}", name="deleteProduct")
     */
    public function deleteProduct(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if(in_array('ROLE_ADMIN', $user->getRoles())){
            $em->remove($product);
            $em->flush();
            return $this->redirectToRoute('shop');
        }

    }
    /**
     * @Route("/shop/ordereditShop/{id}", name="editOrder")
     */
    public function editOrder(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(OrderEdit::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('shop');
        }
        return $this->render('shop/ordereditShop.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/shop/orderdelete/{id}", name="deleteOrder")
     */
    public function deleteOrder(Request $request, OrderProduct $product)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if(in_array('ROLE_ADMIN', $user->getRoles())){
            $orderz = $em->getRepository('App:OrderProduct')->findBy(['id' => $product]);
            $em->remove($orderz);
            $em->flush();
            return $this->redirectToRoute('shop');
        }

    }
}
