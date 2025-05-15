<?php

namespace App\Model;

class Cours
{
    public function __construct(
        private int $id = 0,
        private string $name = '',
        private string $link = '',
        private string $desc = '',
        private string $info = '',
        private string $type = '',
        private string $domaine = '',
    ) {
    } 

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getLink(): string
    {
        return $this->link;
    }
    public function getDesc(): string
    {
        return $this->desc;
    }
    public function getInfo(): string
    {
        return $this->info;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDomaine(): string
    {
        return $this->domaine;
    }
}