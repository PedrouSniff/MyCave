<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        // Création et gestion du formulaire
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données du formulaire
            $data = $form->getData();
    
            // Création de l'email
            $email = (new Email())
                ->from('expediteur@gmail.com')
                ->to('destinataire@live.fr')
                ->subject('Nouveau message de contact')
                ->text(
                    "Objet: {$data['objet']}\n" .
                    "Email: {$data['email']}\n\n" .
                    "Message:\n{$data['message']}"
                );
    
            // Envoi de l'email
            $mailer->send($email);
        }
    
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
