<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Visit;
use App\Form\CarType;
use App\Form\VisitEditType;
use App\Form\VisitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VisitsController extends AbstractController
{
    /**
     * @Route("/visits/register", name="registerVisit")
     */
    public function addVisit(Request $request)
    {

        $car = new Car();
        $visit = new Visit();
        $user = $this->getUser();



        $form = $this->createForm(VisitType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $car->setBrand($form['brand']->getData());
            $car->setModel($form['model']->getData());
            $car->setYear($form['year']->getData());
            $car->setFuelType($form['fuelType']->getData());
            $car->setGearbox($form['gearbox']->getData());
            $car->setRegistrationPlate($form['registrationPlate']->getData());
            $car->setUser($user);

            $visit->setDate($form['date']->getData());
            $visit->setTime($form['time']->getData());
            $visit->setDescription($form['description']->getData());
            $visit->setUser($user);
            $visit->setCar($car);
            $visit->setState(1);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            $entityManager->persist($visit);
            $entityManager->flush();

            return $this->redirectToRoute('allVisits');
        }


        return $this->render('visits/registerVisit.html.twig',[
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/visits/all", name="allVisits")
     */
    public function showVisits(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        if(in_array('ROLE_ADMIN', $user->getRoles()) ||
            in_array('ROLE_MECHANIC', $user->getRoles()))
            $visits = $em->getRepository('App:Visit')->findAll();

        else {
            $visits = $em->getRepository('App:Visit')
                ->findBy(
                    ['user' => $user->getId()]
                );
        }

        return $this->render('visits/allVisits.html.twig',
                ['visits' => $visits
            ]);

    }

    /**
     * @Route("/visits/edit/{id}", name="editVisit")
     */
    public function editUser(Request $request, Visit $visit){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(VisitEditType::class, $visit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($visit);
            $em->flush();

            return $this->redirectToRoute('allVisits');
        }
        return $this->render('visits/editVisit.html.twig', [
            'visit' => $visit,
            'form' => $form->createView()
        ]);
    }

//    /**
//     * @Route("/visits/edit/{id}", name="editVisit)
//     */
//    public function editVisit(Request $request, Visit $visit)
//    {
//
//        $form = $this->createForm(VisitType::class, Visit::class);
//        $form->handleRequest($request);
//
//        return $this->render('visits/editVisit.html.twig',[
//                'form' => $form,
//                'visit' => $visit
//            ]);
//
//    }
}
