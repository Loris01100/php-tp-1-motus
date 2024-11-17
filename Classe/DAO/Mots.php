<?php

class Mots
{
    private string $mot;

    public function __construct(string $mot)
    {
        $this->mot = mb_strtolower($mot);
    }

    public function getMot(): string
    {
        return $this->mot;
    }

}
