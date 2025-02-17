<?php

namespace App\Controller;

use App\Entity\Vins;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DetailsController extends AbstractController
{
    #[Route('/details/{id}', name: 'app_details')]
    public function details(Vins $vins): Response
    {
        return $this->render('details/details.html.twig', [
            'vins'=> $vins,
        ]);
    }
}
