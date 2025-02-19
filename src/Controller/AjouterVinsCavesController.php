<?php

namespace App\Controller;

use App\Entity\Vins;
use App\Entity\CavesVins;
use App\Form\AjouterVinsCavesType;
use App\Repository\VinsRepository;
use App\Repository\CavesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjouterVinsCavesController extends AbstractController
{
    #[Route('/ajouter/vins/caves/{id}', name: 'app_ajouter_vins_caves')]
    public function addVinsCaves(
        VinsRepository $vinsRepository,
        CavesRepository $cavesRepository,
        EntityManagerInterface $entityManager,
        Request $request,
        int $id
    ): Response {
        $user = $this->getUser();
        
        if (!$user) {
            throw $this->createAccessDeniedException("Veuillez vous connecter pour ajouter un vin à votre cave.");
        }
        
        $vins = $vinsRepository->find($id);
        if (!$vins) {
            throw $this->createNotFoundException("Cette bouteille n'existe pas.");
        }
        
        $caves = $cavesRepository->findBy(['user' => $user]);
        if (!$caves) {
            throw $this->createNotFoundException("Veuillez d'abord créer une cave.");
        }
        
        $form = $this->createForm(AjouterVinsCavesType::class, null, ['caves' => $caves]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedCave = $form->get('cave')->getData();
            
            // Vérifier si le vin est déjà dans la cave
            foreach ($selectedCave->getCavesVins() as $caveVin) {
                if ($caveVin->getVins() === $vins) {
                    $this->addFlash('warning', 'Ce vin est déjà dans votre cave.');
                    return $this->redirectToRoute('app_vins');
                }
            }
            
            // Ajouter le vin à la cave
            $cavesVins = new CavesVins();
            $cavesVins->setCaves($selectedCave);
            $cavesVins->setVins($vins);
            
            $entityManager->persist($cavesVins);
            $entityManager->flush();
            
            $this->addFlash('success', 'Le vin a été ajouté à votre cave.');
            return $this->redirectToRoute('app_vins');
        }
        
        return $this->render('ajouter_vins_caves/ajouterVinsCaves.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
