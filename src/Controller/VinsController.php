<?php

namespace App\Controller;

use App\Entity\Vins;
use App\Form\VinsType;
use App\Repository\VinsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

final class VinsController extends AbstractController
{
    #[Route('/vins', name: 'app_vins')]
    public function addbouteilles(Request $request, EntityManagerInterface $entityManager, VinsRepository $repository, UserInterface $user): Response
    {
        // Création d'un nouvel objet Vins
        $vins = new Vins();

        $allVins = $repository->findAll();

        // Création du formulaire en indiquant l'objet sur lequel le formulaire va travailler
        $form = $this->createForm(VinsType::class, $vins);

        // Indique à Symfony de prendre les données et de les associer au formulaire
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            // On marque les informations de l'objet vins prêt à être envoyé en bdd
            $entityManager->persist($vins);

            // On envoie les données
            $entityManager->flush();

            // Message de succès
            $this->addFlash('success', 'Cave ajouté avec succès !');

            // Redirection
            return $this->redirectToRoute('app_vins');
        }

        return $this->render('vins/vins.html.twig', [
            'vinsform' => $form->createView(),
            'allVins' => $allVins,
        ]);
    }
}
