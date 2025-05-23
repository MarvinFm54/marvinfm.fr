<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $username;

    #[ORM\Column(type: 'string', length: 255)]
    private string $pseudo;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $date;

    #[ORM\Column(type: 'string', length: 50)]
    private string $status = "user";

    #[ORM\Column(type: 'text')]
    private string $bio = "Pas encore de bio.";

    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    public function getId(): int {
        return $this->id;
    }
    
    public function getUsername(): string {
        return $this->username;
    }
    
    public function getPseudo(): string {
        return $this->pseudo;
    }
    
    public function getDate(): \DateTimeImmutable {
        return $this->date;
    }    
    
    public function getStatus(): string {
        return $this->status;
    }
    
    public function getBio(): string {
        return $this->bio;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }
    
    public function setPseudo(string $pseudo): void {
        $this->pseudo = $pseudo;
    }
    
    public function setPassword(string $password): void {
        $this->password = $password;
    }
    
    public function getPassword(): string {
        return $this->password;
    }
    
    public function setDate(\DateTimeImmutable $date): \DateTimeImmutable {
        $this->date = $date;
        return $this->date;
    }
    
    
    public function setStatus(string $status): void {
        $this->status = $status;
    }
    
    public function setBio(string $bio): void {
        $this->bio = $bio;
    }



    public function getDateString(): string {
        return $this->date->format('Y-m-d H:i:s');
    }    
}