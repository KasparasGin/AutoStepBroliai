<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Entity\Waybill;
use App\Form\SupplierAddType;
use App\Form\SupplierEditType;
use App\Form\VisitEditType;
use App\Form\VisitType;
use App\Form\WayBillAddType;
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
            $supplier->setAccNumber($form['accNumber']->getData());

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
     * @Route("/suppliers/deleteSupplier/{id}", name="deleteSupplier")
     */
    public function deleteSupplier(Request $request, Supplier $supplier)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if(in_array('ROLE_ADMIN', $user->getRoles())){
            $em->remove($supplier);
            $em->flush();
            return $this->redirectToRoute('suppliers');
        }
        /*return $this->render('suppliers/deleteSupplier.html.twig', [
            'controller_name' => 'SuppliersController',
        ]);*/
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

    /**
     * @Route("/suppliers/waybills", name="allwaybills")
     */
    public function waybills(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $waybills = $em->getRepository('App:Waybill')->findAll();
        return $this->render('suppliers/waybills.html.twig', [
            'waybills' => $waybills,
        ]);
    }

    /**
     * @Route("/suppliers/addWayBill", name="addWayBill")
     */
    public function addWayBill(Request $request)
    {
        $waybill = new WayBill();

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(WayBillAddType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $supplier = $em->getRepository('App:Supplier')->findOneById($form['supplier']->getData());
            $waybill->setSupplier($supplier);
            $waybill->setQuantity($form['quantity']->getData());
            $waybill->setTotalPrice($form['totalPrice']->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($waybill);
            $entityManager->flush();

            return $this->redirectToRoute('allwaybills');
        }
        return $this->render('suppliers/addWayBill.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppliers/requiredParts", name="allRequiredParts")
     */
    public function requiredParts()
    {
        return $this->render('suppliers/requiredParts.html.twig', [
            'controller_name' => 'SuppliersController',
        ]);
    }
}
