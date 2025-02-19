<?php

namespace App\Controller;

use App\Entity\Caves;
use App\Repository\CavesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CavesDetailsController extends AbstractController
{
    #[Route('/caves/details/{id}', name: 'app_caves_details')]
    public function caves(Caves $caves, CavesRepository $cavesRepository): Response
    {
        // Vérifie si l'utilisateur est connecté
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException("Veuillez vous connecter pour accéder aux détails de la cave.");
        }

        // Récupère les bouteilles associées à la cave
        $vins = $caves->getCavesVins();

        return $this->render('caves_details/cavesDetails.html.twig', [
            'caves' => $caves,
            'vins' => $vins,
        ]);
    }
}
