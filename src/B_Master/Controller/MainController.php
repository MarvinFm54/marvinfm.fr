<?php

namespace App\B_Master\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\B_Master\Form\UserType;


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

    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        if ($request->isMethod('POST')) {
            $identifiant = $request->request->get('identifiant');
            $pseudo = $request->request->get('pseudo');
            $mdp2 = $request->request->get('mdp2');
            $mdp3 = $request->request->get('mdp3');

            if ($mdp2 !== $mdp3) {
                // gérer l'erreur mot de passe différent
            } else {
                $user = new User();
                $user->setUsername($identifiant);
                $user->setPseudo($pseudo ?? '');

                // date d'inscription
                $user->setDate((new \DateTime())->format('Y-m-d'));

                // rôle par défaut
                $user->setStatus('user');

                // bio par défaut
                $user->setBio('Pas encore de bio.');

                // hasher le mot de passe
                $hashedPassword = $passwordHasher->hashPassword($user, $mdp2);
                $user->setPassword($hashedPassword);

                $em->persist($user);
                $em->flush();

                // rediriger ou afficher message succès
            }
        }
    }
}
