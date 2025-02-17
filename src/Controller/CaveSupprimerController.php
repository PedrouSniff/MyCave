<?php

namespace App\Controller;

use App\Entity\Caves;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CaveSupprimerController extends AbstractController
{
    #[Route('/cave/supprimer/{id}', name: 'app_cave_supprimer')]
    public function supprimer(Caves $caves, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("SUP". $caves->getId(),$request->get('_token'))){
            $entityManager->remove($caves);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("app_caves"); 
        }
    }
}
