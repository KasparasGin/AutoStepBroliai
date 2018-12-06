<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Visit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RepairController extends AbstractController
{
    /**
     * @Route("/repair/index", name="repair")
     */
    public function showRepairMenu()
    {
        return $this->render('repair/index.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }
    /**
     * @Route("/repair/createNote", name="createNote")
     */
    public function createNote(Request $request)
    {
        $note = new Note();

        $form = $this->createForm(Note::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note->setComment($form['note']->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($note);
            $entityManager->flush();

            return $this->redirectToRoute('allVisits');
        }

        return $this->render('repair/createNote.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }
    /**
     * @Route("/repair/reserveTool", name="reserveTool")
     */
    public function reserveTool()
    {
        return $this->render('repair/reserveTool.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }
    /**
     * @Route("/repair/addRepairAction", name="addRepairAction")
     */
    public function addRepairAction()
    {
        return $this->render('repair/addRepairAction.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }
    /**
     * @Route("/repair/orderPart", name="orderPart")
     */
    public function orderPart()
    {
        return $this->render('repair/orderPart.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }
    /**
     * @Route("/repair/describePart", name="describePart")
     */
    public function describePart()
    {
        return $this->render('repair/describePart.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }
    /**
     * @Route("/repair/repairManuals", name="repairManuals")
     */
    public function repairManuals()
    {
        return $this->render('repair/timeTable.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }
}
