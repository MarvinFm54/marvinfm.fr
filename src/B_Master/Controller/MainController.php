<?php

namespace App\B_Master\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        return $this->render('master/master.html.twig', [
            'urls' => [
                'studies' => 'https://cours.marvinfm.fr',
                'subdomains' => 'https://subdomains.marvinfm.fr',
                'register' => '/?p=register',
            ],
            'pages' => [
                'studies' => 'Cours',
                'subdomains' => 'Sous-domaines',
                'register' => "S'inscrire",
            ],
            'currentPage' => '',
            'user' => false,
            'user_name' => 'Test',
        ]);
    }
}
