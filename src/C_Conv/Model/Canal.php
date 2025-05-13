<?php

namespace App\C_Conv\Model;

class Canal
{
    public function __construct(

        private int $id = 0,
        private int $branch_id = 0,
        private int $user_owner_id = 0,
        private int $user_creator_id = 0,

        private string $name = "",
        private string $description = "",
        private string $theme = "",
        private string $styles = "",
        private string $type = "",
        private string $visibility = "",
    ) {
        if ($this->name == ""){
            $this->name = "Canal $id";
        }
    } 

    public function getId(): int
    {
        return $this->id;
    }

    public function getBranchId(): int
    {
        return $this->branch_id;
    }

    public function getUserOwnerId(): int
    {
        return $this->user_owner_id;
    }

    public function getUserCreatorId(): int
    {
        return $this->user_creator_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    public function getStyles(): string
    {
        return $this->styles;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getVisibility(): string
    {
        return $this->visibility;
    }
}