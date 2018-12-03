<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SuppliersController extends AbstractController
{
    /**
     * @Route("/suppliers", name="suppliersMenu")
     */
    public function showSuppliersMenu()
    {
        return $this->render('suppliers/index.html.twig', [
            'controller_name' => 'SuppliersController',
        ]);
    }
}
