<?php

namespace App\Model;

class Message
{
    public function __construct(

        private int $id = 0,
        private int $canal_id = 0,
        private int $user_id = 0,

        private string $date = "",
        private string $text = "",

        private bool $visible = true,
    ) {
    } 

    public function getId(): int
    {
        return $this->id;
    }

    public function getCanalId(): int
    {
        return $this->canal_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }
}