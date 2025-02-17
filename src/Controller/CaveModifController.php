<?php

namespace App\Controller;

use App\Entity\Caves;
use App\Form\CavesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CaveModifController extends AbstractController
{
    #[Route('/cave/modif/{id}', name: 'app_cave_modif')]
    public function modifier(Caves $caves, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
        $form = $this->createForm(CavesType::class, $caves); 

        // Indique à Symfony de prendre les données et de les associer au formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire est soumis et qu'il est valide
        if ($form->isSubmitted() && $form->isValid()) {

            // On marque les informations de l'objet caves prêt à être envoyé en base de données
            $entityManager->persist($caves);

            // On envoie les données
            $entityManager->flush();

            // Message de succès
            $this->addFlash('success', 'Votre cave a bien été modifiée !');

            // Redirection
            return $this->redirectToRoute('app_caves');
        }

        return $this->render('cave_modif/cavemodif.html.twig', [
            'modifCavesForm'=>$form->createView(),   
        ]);
    }
}
