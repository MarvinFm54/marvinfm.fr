<?php

namespace App\Model;

class Branch
{
    public function __construct(

        private int $id = 0,
        private int $branch_parent_id = 0,

        private string $name = "",
        private string $description = "",
        private string $theme = "",
    ) {
        $this->name = "Branch $id";
    } 

    public function getId(): int
    {
        return $this->id;
    }

    public function getBranchParentId(): int
    {
        return $this->branch_parent_id;
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
}