<?php
namespace App\Controller;

use App\Model\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    #[Route(path: '/', name: 'master')] 

    public function homepage(Request $request): Response{
        
        $user = new User();
        $form = $this->createForm(type: UserType::class, data: $user);
        $form->handleRequest(request: $request);

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
            'form' => $form->createView(),
        ]);
    }
}
