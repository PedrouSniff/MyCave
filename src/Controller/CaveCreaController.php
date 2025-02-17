<?php

namespace App\Controller;

use App\Entity\Caves;
use App\Form\CavesType;
use App\Repository\CavesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CaveCreaController extends AbstractController
{
    #[Route('/cave/crea', name: 'app_cave_crea')]
    public function caveCrea(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'un nouvel objet Caves
        $caves = new Caves();

        // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
        $form = $this->createForm(CavesType::class, $caves);

        // Indique à Symfony de prendre les données et de les associer au formulaire
        $form->handleRequest($request);
        
        $get = $this->getUser(); 

        if ($form->isSubmitted() && $form->isValid()) {

            $caves->setUser($get);

            $entityManager->persist($get);  
            
            // On marque les informations de l'objet caves prêt à être envoyé en bdd
            $entityManager->persist($caves);

            // On envoie les données
            $entityManager->flush();

            // Message de succès
            $this->addFlash('success', 'Cave ajouté avec succès !');

            // Redirection
            return $this->redirectToRoute('app_home');
        }

        return $this->render('cave_crea/caveCrea.html.twig', [
            'caveform' => $form->createView(),
        ]);
    }
}   
