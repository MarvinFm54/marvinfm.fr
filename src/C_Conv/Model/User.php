<?php

namespace App\C_Conv\Model;

class User
{
    public function __construct(

        private int $id = 0,
        private string $username = "identifiant",
        private string $pseudo = "Pseudo",
        private string $date = "14-05-2025",
        private string $status = "user",
        private string $bio = "Pas encore de bio.",
    ) {
    } 

    public function getId(): int {
        return $this->id;
    }
    
    public function getUsername(): string {
        return $this->username;
    }
    
    public function getPseudo(): string {
        return $this->pseudo;
    }
    
    public function getDate(): string {
        return $this->date;
    }
    
    public function getStatus(): string {
        return $this->status;
    }
    
    public function getBio(): string {
        return $this->bio;
    }
}