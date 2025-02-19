<?php

namespace App\Controller;

use App\Repository\CavesRepository;
use App\Repository\VinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(CavesRepository $cavesrepository, VinsRepository $Vinsrepository): Response
    {
        $allVins = $Vinsrepository->findBy([], ['id' => 'DESC'], 3);
        $dernieresCaves = $cavesrepository->findBy([], ['id' => 'DESC'], 6);
        
        return $this->render('home/home.html.twig', [
            'caves' => $dernieresCaves,
            'allVins' => $allVins,
        ]);
    }
}
    