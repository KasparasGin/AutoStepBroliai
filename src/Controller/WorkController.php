<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WorkController extends AbstractController
{
    /**
     * @Route("/work/index", name="work")
     */
    public function showWorkMenu()
    {
        return $this->render('work/index.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
    /**
     * @Route("/work/addWork", name="addWork")
     */
    public function addWork()
    {
        return $this->render('work/addWork.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
    /**
     * @Route("/work/editWork", name="editWork")
     */
    public function editWork()
    {
        return $this->render('work/editWork.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
    /**
     * @Route("/work/deleteWork", name="deleteWork")
     */
    public function deleteWork()
    {
        return $this->render('work/deleteWork.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
    /**
     * @Route("/work/changeTimeNeeded", name="changeTimeNeeded")
     */
    public function changeTimeNeeded()
    {
        return $this->render('work/changeTimeNeeded.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }
     /**
     * @Route("/work/confirmCompletion", name="confirmCompletion")
     */
    public function confirmCompletion()
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
