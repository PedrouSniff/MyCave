<?php

namespace App\Controller;

use App\Entity\Vins;
use App\Form\VinsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class VinsModifController extends AbstractController
{
    #[Route('/vins/modif/{id}', name: 'app_vins_modif')]
    public function modifvins(Vins $vins, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
        $form = $this->createForm(VinsType::class, $vins); 

        // Indique à Symfony de prendre les données et de les associer au formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire est soumis et qu'il est valide
        if ($form->isSubmitted() && $form->isValid()) {

            // On marque les informations de l'objet vins prêt à être envoyé en base de données
            $entityManager->persist($vins);

            // On envoie les données
            $entityManager->flush();

            // Message de succès
            $this->addFlash('success', 'Votre vin a bien été modifiée !');

            // Redirection
            return $this->redirectToRoute('app_vins');
        }

        return $this->render('vins_modif/vinsmodif.html.twig', [
            'modifVinsForm'=>$form->createView(),   
        ]);
    }
}
