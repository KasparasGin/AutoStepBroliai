<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Entity\Visit;
use App\Form\SupplierAddType;
use App\Form\SupplierEditType;
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
    public function showSuppliersMenu(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $suppliers = $em->getRepository('App:Supplier')->findAll();
        /*if(in_array('ROLE_ADMIN', $user->getRoles()) ||
            in_array('ROLE_MECHANIC', $user->getRoles()))
            $suppliers = $em->getRepository('App:Supplier')->findAll();

        else {
            $suppliers = $em->getRepository('App:Supplier')
                ->findBy(
                    ['user' => $user->getId()]
                );
        }*/
        return $this->render('suppliers/index.html.twig', [
            'suppliers' => $suppliers,
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
     * @Route("/suppliers/editSupplier/{id}", name="editSupplier")
     */
    public function editSupplier(Request $request, Supplier $supplier)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SupplierEditType::class, $supplier);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($supplier);
            $em->flush();

            return $this->redirectToRoute('suppliers');
        }
        return $this->render('suppliers/editSupplier.html.twig', [
            'supplier' => $supplier,
            'form' => $form->createView()
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
