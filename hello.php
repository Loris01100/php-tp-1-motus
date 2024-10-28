<?php
$mot = ["Peche", "Camion", "Banane", "Voiture", "Douche", "Gymnastique"];

$motatrouver = strtolower($mot[array_rand($mot)]);
$reponse = "";
$motLength = strlen($motatrouver);

echo "Motus\n";

while ($reponse !== $motatrouver) {

    $reponse = strtolower(readline("Mot (" . $motLength . " lettres) : "));

    if (strlen($reponse) != $motLength) {
        echo "Le mot fait " . $motLength . " lettres.\n";
        continue;
    }

    $feedback = "";
    $lettresMarquees = [];

    for ($i = 0; $i < $motLength; $i++) {
        if ($reponse[$i] == $motatrouver[$i]) {
            $feedback .= strtoupper($reponse[$i]);
            $lettresMarquees[$i] = true;
        } else {
            $lettresMarquees[$i] = false;
        }
    }

    for ($i = 0; $i < $motLength; $i++) {
        if (!$lettresMarquees[$i]) {
            if (strpos($motatrouver, $reponse[$i]) !== false && substr_count($reponse, $reponse[$i]) <= substr_count($motatrouver, $reponse[$i])) {

                $essai .= "(" . $reponse[$i] . ")";
            } else {

                $essai .= "*";
            }
        }
    }

    echo "Résultat : $feedback\n";

    if ($reponse === $motatrouver) {
        echo "Bravo ! Vous avez trouvé le mot : " . ucfirst($motatrouver) . "\n";
        break;
    } else {
        echo "Essayez encore.\n";
    }
}