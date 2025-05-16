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
        
        $user = $em->getRepository(User::class)->findOneBy(['username' => $username]);
    
        if (!$user) {
            $session->getFlashBag()->add('error', 'Utilisateur introuvable.');
            return 'error';
        }
    
        if (!$passwordHasher->isPasswordValid($user, $password)) {
            $session->getFlashBag()->add('error', 'Mot de passe incorrect.');
            return 'error';
        }
    
        $session->set('user', $user->getUsername());
    
        return 'success';
    }
    
}

