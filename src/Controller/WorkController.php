<?php

namespace App\Controller;

use App\Entity\Work;
use App\Form\WorkAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class WorkController extends AbstractController
{
    /**
     * @Route("/work/index", name="work")
     */
    public function showWorkMenu(Request $request)
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
        return $this->render('work/index.html.twig', [
            'works' => $works,
        ]);
    }
    /**
     * @Route("/work/addWork", name="addWork")
     */
    public function addWork(Request $request)
    {
        $work = new Work();

        $form = $this->createForm(WorkAddType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $work->setType($form['type']->getData());
            $work->setDescription($form['description']->getData());
            $work->setTimeNeeded($form['timeNeeded']->getData());
            $work->setCompletion(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($work);
            $entityManager->flush();

            return $this->redirectToRoute('work');
        }
        return $this->render('work/addWork.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/work/editWork", name="editWork")
     */
    public function editWork(Request $request)
    {
        return $this->render('work/editWork.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
    /**
     * @Route("/work/deleteWork", name="deleteWork")
     */
    public function deleteWork(Request $request)
    {
        return $this->render('work/deleteWork.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
    /**
     * @Route("/work/changeTimeNeeded", name="changeTimeNeeded")
     */
    public function changeTimeNeeded(Request $request)
    {
        return $this->render('work/changeTimeNeeded.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
     /**
     * @Route("/work/confirmCompletion", name="confirmCompletion")
     */
    public function confirmCompletion(Request $request)
    {
        return $this->render('work/confirmCompletion.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
     /**
     * @Route("/work/timeTable", name="timeTable")
     */
    public function timeTable()
    {
        return $this->render('work/timeTable.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
}
