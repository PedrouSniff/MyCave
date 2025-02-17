<?php

namespace App\Controller;

use App\Repository\CavesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(CavesRepository $cavesrepository): Response
    {
        $dernieresCaves = $cavesrepository->findBy([], ['id' => 'DESC'], 6);
        
        return $this->render('home/home.html.twig', [
            'caves' => $dernieresCaves,
        ]);
    }
}
    