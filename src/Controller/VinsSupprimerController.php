<?php

namespace App\Controller;

use App\Entity\Vins;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class VinsSupprimerController extends AbstractController
{
    #[Route('/vins/supprimer/{id}', name: 'app_vins_supprimer')]
    public function supprimer(Vins $vins, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("SUP". $vins->getId(),$request->get('_token'))){
            $entityManager->remove($vins);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("app_vins");
        }
    }
}
