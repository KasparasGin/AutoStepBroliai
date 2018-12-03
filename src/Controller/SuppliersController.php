<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SuppliersController extends AbstractController
{
    /**
     * @Route("/suppliers/index", name="suppliers")
     */
    public function showSuppliersMenu()
    {
        return $this->render('suppliers/index.html.twig', [
            'controller_name' => 'SuppliersController',
        ]);
    }

    /**
     * @Route("/suppliers/addSupplier", name="addSupplier")
     */
    public function addSupplier()
    {
        return $this->render('suppliers/addSupplier.html.twig', [
            'controller_name' => 'SuppliersController',
        ]);
    }

    /**
     * @Route("/suppliers/editSupplier", name="editSupplier")
     */
    public function editSupplier()
    {
        return $this->render('suppliers/editSupplier.html.twig', [
            'controller_name' => 'SuppliersController',
        ]);
    }

    /**
     * @Route("/suppliers/deleteSupplier", name="deleteSupplier")
     */
    public function deleteSupplier()
    {
        return $this->render('suppliers/deleteSupplier.html.twig', [
            'controller_name' => 'SuppliersController',
        ]);
    }

    /**
     * @Route("/suppliers/paymentsForSuppliers", name="paymentsForSuppliers")
     */
    public function paymentsForSuppliers()
    {
        return $this->render('suppliers/paymentsForSuppliers.html.twig', [
            'controller_name' => 'SuppliersController',
        ]);
    }
}
