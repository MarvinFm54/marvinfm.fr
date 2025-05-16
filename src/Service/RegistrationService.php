<?php
namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function registerUser(string $identifiant, ?string $pseudo, string $mdp2, string $mdp3): string
    {
        if ($mdp2 !== $mdp3) {
            return "Les mots de passe ne correspondent pas.";
        }

        if (strlen($identifiant) < 3) {
            return "L'identifiant est trop court (min 3 caractères).";
        }

        if (strlen($identifiant) > 12) {
            return "L'identifiant est trop long (max 12 caractères).";
        }

        if (strlen($mdp2) < 4) {
            return "Le mot de passe est trop court (min 4 caractères).";
        }

        if (strlen($mdp2) > 16) {
            return "Le mot de passe est trop long (max 16 caractères).";
        }

        $existingUser = $this->em->getRepository(User::class)->findOneBy(['username' => $identifiant]);
        if ($existingUser) {
            return "Cet identifiant est déjà utilisé.";
        }

        $user = new User();
        $user->setUsername($identifiant);
        $user->setPassword(password_hash($mdp2, PASSWORD_BCRYPT));
        $user->setStatus('user');
        $user->setDate(new \DateTimeImmutable());
        $user->setPseudo($pseudo ?? $identifiant);

        $this->em->persist($user);
        $this->em->flush();

        return "Compte créé avec succès.";
    }
}

