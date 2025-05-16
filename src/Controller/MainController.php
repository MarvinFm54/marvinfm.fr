<?php
namespace App\Controller;

use App\Service\RegistrationService;
use App\Service\ConnectionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;





class MainController extends AbstractController
{
    #[Route(path: '/', name: 'master', methods: ['GET', 'POST'])]

    public function homepage(
        Request $request,
        CsrfTokenManagerInterface $csrfManager,
        RegistrationService $registrationService,
        ConnectionService $connectionService,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ){

        /*) --- Fonction Main --- (*/

        $view = $request->query->get(key: 'p');
        $page = $request->getUri();
        $session = $request->getSession();

        
        $this->inscription(
            request: $request, 
            csrfManager: $csrfManager, 
            registrationService: $registrationService);
        $this->connection(
            request: $request, 
            csrfManager: $csrfManager, 
            connectionService: $connectionService, 
            session: $session,
            em: $em,
            passwordHasher: $passwordHasher,
            page: $page,
        );

        return $this->render(view: 'B_Master/master.html.twig', parameters: [
            'currentView' => $view,
        ]);
    }
    
    public function connection(
        Request $request, 
        CsrfTokenManagerInterface $csrfManager,
        ConnectionService $connectionService,
        SessionInterface $session,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        string $page
    ): RedirectResponse {

        /*) --- Fonction Connection --- (*/
        
        $token = $request->request->get('_token');
        if (!$csrfManager->isTokenValid(new CsrfToken('connection', $token))) {
            $this->addFlash('error', 'Jeton CSRF invalide.');
            return $this->redirectToRoute('master', [
                'p' => $page,
                'action' => 'connection',
            ]);
        }

        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $connectionService->connectUser($username, $password, $session, $em, $passwordHasher);

        return $this->redirectToRoute('master', [
            'p' => $page,
            'a' => 'connection',
        ]);
    }

    public function inscription(
        Request $request, 
        CsrfTokenManagerInterface $csrfManager,
        RegistrationService $registrationService
    ) {

        /*) --- Fonction Inscription --- (*/
        
        if ($request->isMethod(method: 'POST') && $request->request->has(key: 'inscription')) {

            $token = $request->request->get(key: '_token');
            if (!$csrfManager->isTokenValid(token: new CsrfToken(id: 'register', value: $token))) {
                $this->addFlash(type: 'error', message: 'Jeton CSRF invalide.');
                return $this->redirectToRoute(route: 'master', parameters: ['p' => 'register']);
            }

            $identifiant = $request->request->get(key: 'identifiant');
            $pseudo = $request->request->get(key: 'pseudo');
            $mdp2 = $request->request->get(key: 'mdp2');
            $mdp3 = $request->request->get(key: 'mdp3');

            $resultRegister = $registrationService->registerUser(identifiant: $identifiant, pseudo: $pseudo, mdp2: $mdp2, mdp3: $mdp3);

            $this->addFlash(
                type: $resultRegister === "Compte créé avec succès." ? 'success' : 'error',
                message: $resultRegister
            );

            return $this->redirectToRoute(route: 'master', parameters: ['p' => 'register']);
        }
    }
}
