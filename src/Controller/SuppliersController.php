<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Entity\Visit;
use App\Form\SupplierAddType;
use App\Form\VisitEditType;
use App\Form\VisitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function addSupplier(Request $request)
    {
        $supplier = new Supplier();

        $form = $this->createForm(SupplierAddType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $supplier->setCompanyCode($form['company_code']->getData());
            $supplier->setName($form['name']->getData());
            $supplier->setAddress($form['address']->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($supplier);
            $entityManager->flush();

            return $this->redirectToRoute('suppliers');
        }
        return $this->render('suppliers/addSupplier.html.twig', [
            'form' => $form->createView(),
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
