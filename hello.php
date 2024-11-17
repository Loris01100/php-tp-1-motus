<?php

use TpMotus\DTO\MotDAO;
use TpMotus\DTO\Motus;


require_once __DIR__ . '/vendor/autoload.php';


require_once 'Classe/DAO/Mots.php';
require_once 'Classe/DTO/MotDAO.php';
require_once 'Classe/DTO/Motus.php';

$mots = ["peche", "camion", "banane", "voiture", "douche", "abricot", "tomate", "maman", "famille", "terre", "velos", "ecran", "maths", "logique", "arcane", "magie", "poudre", "violet", "rouge", "manger", "fruit", "légume"];
$motDAO = new MotDAO($mots);
$jeuMotus = new Motus($motDAO);

$jeuMotus->jouer();


