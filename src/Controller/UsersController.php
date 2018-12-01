<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users/allUsers", name="allUsers")
     */
    public function showAllUsers()
    {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('App:User')->findAll();



        return $this->render('users/userList.html.twig', ['users' => $users, ]);
    }

    /**
     * @Route("/users/editUser/{id}", name="editUser")
     */
    public function editUser(Request $request, User $user){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();
        }
        return $this->render('users/editUser.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
