<?php
namespace App\Controller;

use App\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class MainController extends AbstractController
{
    #[Route(path: '/', name: 'master', methods: ['GET', 'POST'])]
    public function homepage(
        Request $request,
        RegistrationService $registrationService,
        CsrfTokenManagerInterface $csrfManager
    ): Response {
        $page = $request->query->get('p');
        
        if ($request->isMethod('POST') && $request->request->has('inscription')) {
            $token = $request->request->get('_token');

            if (!$csrfManager->isTokenValid(new CsrfToken('register', $token))) {
                $this->addFlash('error', 'Jeton CSRF invalide.');
                return $this->redirectToRoute('master', ['p' => 'register']);
            }

            $identifiant = $request->request->get('identifiant');
            $pseudo = $request->request->get('pseudo');
            $mdp2 = $request->request->get('mdp2');
            $mdp3 = $request->request->get('mdp3');

            $resultRegister = $registrationService->registerUser($identifiant, $pseudo, $mdp2, $mdp3);

            $this->addFlash(
                $resultRegister === "Compte créé avec succès." ? 'success' : 'error',
                $resultRegister
            );

            return $this->redirectToRoute('master', ['p' => 'register']);
        }

        return $this->render('B_Master/master.html.twig', [
            'currentPage' => $page,
        ]);
    }
}
