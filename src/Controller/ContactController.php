<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function sendEmail(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form['email']->getData();
            $text = $form['message']->getData();


            $message = (new \Swift_Message("Laiškas nuo kliento"))
                ->setFrom($email)
                ->setTo("skiperispingvinauskas@gmail.com")
                ->setBody($this->renderView('contact/contactMessage.html.twig', array('text' => $text, 'email' => $email)), 'text/html');

            $mailer->send($message);
        }



        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
