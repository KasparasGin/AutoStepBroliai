<?php

namespace App\Controller;

use App\Entity\BrokenPartDescription;
use App\Entity\Note;
use App\Entity\OrderPart;
use App\Entity\RepairAction;
use App\Entity\Tool;
use App\Entity\ToolReservation;
use App\Entity\Visit;
use App\Form\BrokenPartDescriptionType;
use App\Form\NoteType;
use App\Form\OrderPartType;
use App\Form\RepairActionType;
use App\Form\ReserveToolType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RepairController extends AbstractController
{
    /**
     * @Route("/result/success", name="success")
     */
    public function showSuccess()
    {
        return $this->render('result/success.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }

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

        $em = $this->getDoctrine()->getManager();
        $works = $em->getRepository('App:Work')->findAll();

        $form = $this->createForm(NoteType::class,  null, array(
            'works' => $works,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note->setComment($form['note']->getData());
            $note->setWork($form['work']->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($note);
            $entityManager->flush();

            return $this->redirectToRoute('success');
        }

        return $this->render('repair/createNote.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/repair/reserveTool", name="reserveTool")
     */
    public function reserveTool(Request $request)
    {
        $reservation = new ToolReservation();
        $em = $this->getDoctrine()->getManager();
        $tools = $em->getRepository('App:Tool')->findAll();

        $form = $this->createForm(ReserveToolType::class, null, array(
            'tools' => $tools,
        ));
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $tool = $form['tool']->getData();
            $toolReservations = $tool->getToolReservations();
            $reservation->setStartDate($form['startDate']->getData());
            $reservation->setEndDate($form['endDate']->getData());

            if ($reservation->getStartDate() > $reservation->getEndDate()) {
                return $this->redirectToRoute('badDate');
            }

            $isFree = true;
            $reservationsCount = 0;
            foreach ($toolReservations as $value) {
                $reservationsCount++;
                if (!($reservation->getEndDate() < $value->getStartDate() || $reservation->getStartDate() > $value->getEndDate())) {
                    $isFree = false;
                    break;
                }
            }
            if ($reservationsCount == 0) $isFree = true;

            if (!$isFree) {
                return $this->redirectToRoute('toolTaken');
            }

            $reservation->setTool($form['tool']->getData());
            $reservation->setUser($user);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('success');
        }


        return $this->render('repair/reserveTool.html.twig', [
            'tools' => $tools,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/repair/addRepairAction", name="addRepairAction")
     */
    public function addRepairAction(Request $request)
    {
        $action = new RepairAction();

        $em = $this->getDoctrine()->getManager();
        $works = $em->getRepository('App:Work')->findAll();

        $form = $this->createForm(RepairActionType::class,  null, array(
            'works' => $works,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $action->setComment($form['comment']->getData());
            $action->setDate($form['date']->getData());
            $action->setWork($form['work']->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($action);
            $entityManager->flush();

            return $this->redirectToRoute('success');
        }

        return $this->render('repair/addRepairAction.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/repair/orderPart", name="orderPart")
     */
    public function orderPart(Request $request)
    {
        $action = new OrderPart();
        $form = $this->createForm(OrderPartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $action->setTitle($form['title']->getData());
            $action->setAmount($form['amount']->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($action);
            $entityManager->flush();

            return $this->redirectToRoute('success');
        }
        return $this->render('repair/orderPart.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/repair/describePart", name="describePart")
     */
    public function describePart(Request $request)
    {
        $action = new BrokenPartDescription();
        $em = $this->getDoctrine()->getManager();
        $works = $em->getRepository('App:Work')->findAll();

        $form = $this->createForm(BrokenPartDescriptionType::class,  null, array(
            'works' => $works,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $action->setDescription($form['description']->getData());
            $action->setDate($form['date']->getData());
            $action->setWork($form['work']->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($action);
            $entityManager->flush();

            return $this->redirectToRoute('success');
        }
        return $this->render('repair/describePart.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/repair/repairManuals", name="repairManuals")
     */
    public function repairManuals()
    {
        return $this->render('repair/repairManuals.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }

    /**
     * @Route("/repair/badDate", name="badDate")
     */
    public function badDate()
    {
        return $this->render('repair/badDate.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }

    /**
     * @Route("/repair/toolTaken", name="toolTaken")
     */
    public function toolTaken()
    {
        return $this->render('repair/toolTaken.html.twig', [
            'controller_name' => 'RepairController',
        ]);
    }
}
