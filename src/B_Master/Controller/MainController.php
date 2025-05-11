<?php

namespace App\B_Master\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route(path: '/')]
    public function homepage(Request $request): Response{
        
        $page = $request->query->get(key: 'p');
        return $this->render(view: 'B_Master/master.html.twig', parameters: [
            'urls' => [
                'studies' => '/cours',
                'subdomains' => 'https://subdomains.marvinfm.fr',
                'register' => '/?p=register',
            ],
            'pages' => [
                'studies' => 'Cours',
                'subdomains' => 'Sous-domaines',
                'register' => "S'inscrire",
            ],
            'currentPage' => $page,
            'user' => false,
            'user_name' => 'Test',

            'style_main' => 'styles/styles_main.css',
        ]);
    }
}
