<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = new User(); // Création d'un nouvel User
    
        // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
        $form = $this->createForm(UserType::class, $user);
    
        // Indique à Symfony de prendre les données et de les associer au formulaire
        $form->handleRequest($request);

        // Vérification si l'email existe déjà (Si jamais j'en ai besoin)

        // if($entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()])){
        //     $this->addFlash('error', 'Cet email est déjà utilisé. Veuillez en choisir un autre.');
        //     return $this->redirectToRoute('app_inscription');
        // }
    
        // Vérification si le formulaire est soumis et qu'il est valide
        if ($form->isSubmitted() && $form->isValid()){

            $user->setRoles(['ROLE_USER']);
            $user->setPassword(
                $passwordEncoder->hashPassword($user,$form->get('password')->getData())
            );

            // On marque les informations de l'objet pizza prêt à être envoyé en bdd
            $entityManager->persist($user);

            // On envoie les données
            $entityManager->flush();
    
            // Message de succès
            $this->addFlash('success', 'Bienvenue !');
    
            // Redirection
            return $this->redirectToRoute('app_login');
        }

        return $this->render('inscription/inscription.html.twig', [
            'userform' => $form->createView()
        ]);
    }
}
