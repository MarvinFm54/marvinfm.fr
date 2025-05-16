<?php
namespace App\Service;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;


class ConnectionService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function connectUser(
        string $username,
        string $password,
        SessionInterface $session,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): string {
        // Rechercher l'utilisateur en base
        $user = $em->getRepository(User::class)->findOneBy(['username' => $username]);
    
        if (!$user) {
            $session->getFlashBag()->add('error', 'Utilisateur introuvable.');
            return 'error';
        }
    
        // Vérifier le mot de passe
        if (!$passwordHasher->isPasswordValid($user, $password)) {
            $session->getFlashBag()->add('error', 'Mot de passe incorrect.');
            return 'error';
        }
    
        // Stocker le nom dans la session
        $session->set('user', $user->getUsername());
    
        return 'success';
    }
    
}

