<?php

namespace App\Controller;

use App\Entity\Work;
use App\Form\WorkAddType;
use App\Form\EditWorkType;
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

            return $this->redirectToRoute('works');
        }
        return $this->render('works/addWork.html.twig', [
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
            in_array('ROLE_MECHANIC', $user->getRoles())){
            $em->remove($work);
            $em->flush();
            return $this->redirectToRoute('works');
        }
        
    }
    /**
     * @Route("/work/changeTimeNeeded", name="changeTimeNeeded")
     */
    public function changeTimeNeeded(Request $request)
    {
        return $this->render('works/changeTimeNeeded.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
     /**
     * @Route("/work/confirmCompletion", name="confirmCompletion")
     */
    public function confirmCompletion(Request $request)
    {
        return $this->render('works/confirmCompletion.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
     /**
     * @Route("/work/timeTable", name="timeTable")
     */
    public function timeTable()
    {
        return $this->render('works/timeTable.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
}
