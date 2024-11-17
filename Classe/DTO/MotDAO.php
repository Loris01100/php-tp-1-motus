<?php

namespace TpMotus\DTO;


use Mots;

class MotDAO
{
    private array $mots;

    public function __construct(array $mots)
    {
        $this->mots = $mots;
    }

    public function MotAleatoire(): Mots
    {
        return new Mots($this->mots[array_rand($this->mots)]);
    }
}
