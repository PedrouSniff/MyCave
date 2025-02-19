<?php

namespace App\Controller;

use App\Repository\CavesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SupprimerVinsCavesController extends AbstractController
{
    #[Route('/supprimer/vins/caves/{caves}/vin/{vin}', name: 'app_supprimer_vins_caves')]
    public function supprimerVinsCaves(int $caves, int $vin, CavesRepository $cavesRepository, EntityManagerInterface $entityManager): Response
    {
            $cave = $cavesRepository->find($caves);

            $cavesVins = $cave->getCavesVins();
            $caveVin = null;

            foreach ($cavesVins as $cv) {
                if ($cv->getVins()->getId() === $vin) {
                    $caveVin = $cv;
                    break;
                }

            if ($caveVin) {
                $cave->removeCavesVin($caveVin);
                $entityManager->remove($caveVin);
                $entityManager->flush();    
            } else {
                throw $this->createNotFoundException("Vin non trouvé dans cette cave.");
            }

            return $this->redirectToRoute('app_caves_details', ['id' => $caves]);
        }
    }
}

