<?php

namespace App\Controller;

use App\Repository\CavesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CavesController extends AbstractController
{
    #[Route('/caves', name: 'app_caves')]
    public function caves(CavesRepository $repository): Response
    {
        $allCaves = $repository->findAll();

        return $this->render('caves/caves.html.twig', [
            'allCaves' => $allCaves
        ]);
    }
}
