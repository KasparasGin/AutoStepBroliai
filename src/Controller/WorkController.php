<?php

namespace App\Controller;

use App\Entity\Work;
use App\Entity\TimeTable;
use App\Entity\User;
use App\Entity\Car;
use App\Entity\Visit;
use App\Form\WorkAddType;
use App\Form\EditWorkType;
use App\Form\WorkCompletionType;
use App\Form\ChangeTimeNeededType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class WorkController extends AbstractController
{
    /**
     * @Route("/works/index", name="works")
     */
    public function showWorksMenu(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $works = $em->getRepository('App:Work')->findAll();
        /*if(in_array('ROLE_ADMIN', $user->getRoles()) ||
            in_array('ROLE_MECHANIC', $user->getRoles()))
            $works = $em->getRepository('App:Work')->findAll();

        else {
            $works = $em->getRepository('App:Work')
                ->findBy(
                    ['user' => $user->getId()]
                );
        }*/
        return $this->render('works/index.html.twig', [
            'works' => $works,
        ]);
    }
    /**
     * @Route("/works/addWork", name="addWork")
     */
    public function addWork(Request $request)
    {
        $work = new Work();
        $em = $this->getDoctrine()->getManager();
        $visits = $em->getRepository('App:Visit')->findAll();

        $form = $this->createForm(WorkAddType::class, null, array(
            'visits' => $visits,
        ));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $visit = $form['visit']->getData();

            $work->setType($form['type']->getData());
            $work->setDescription($form['description']->getData());
            $work->setTimeNeeded($form['timeNeeded']->getData());
            $work->setCompletion(0);
            $work->setAdded(0);
            $work->setVisit($form['visit']->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($work);
            $entityManager->flush();

            return $this->redirectToRoute('works');
        }
        return $this->render('works/addWork.html.twig', [
            'visits' => $visits,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/works/editWork/{id}", name="editWork")
     */
    public function editWork(Request $request, Work $work)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(EditWorkType::class, $work);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($work);
            $em->flush();

        return $this->redirectToRoute('works');
        }
        return $this->render('works/editWork.html.twig', [
            'work' => $work,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/works/deleteWork/{id}", name="deleteWork")
     */
    public function deleteWork(Request $request, Work $work)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if(in_array('ROLE_ADMIN', $user->getRoles()) ||
            in_array('ROLE_MECHANIC', $user->getRoles()) &&
            in_array('1', $work->getCompletion())){
            $em->remove($work);
            $em->flush();
            return $this->redirectToRoute('works');
        }
        
    }
    /**
     * @Route("/works/changeTimeNeeded\{id}", name="changeTimeNeeded")
     */
    public function changeTimeNeeded(Request $request, Work $work)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ChangeTimeNeededType::class, $work);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $work->setTimeNeeded($form['timeNeeded']->getData());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($work);
        $entityManager->flush();

        return $this->redirectToRoute('works');
        }
        return $this->render('works/changeTimeNeeded.html.twig', [
            'form' => $form->createView(),
        ]);
    }
     /**
     * @Route("/works/confirmCompletion/{id}", name="confirmCompletion")
     */
    public function confirmCompletion(Request $request, Work $work)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(WorkCompletionType::class, $work);
        $form->handleRequest($request);

        $work->setCompletion(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($work);
        $entityManager->flush();

        return $this->redirectToRoute('works');
       
    }
     /**
     * @Route("/works/timeTable", name="timeTable")
     */
    public function timeTable(Request $request)
    {
        $timeTable = new TimeTable();
        $em = $this->getDoctrine()->getManager();

        return $this->render('works/timeTable.html.twig', [
            'works' => $works,
        ]);
    }
}
