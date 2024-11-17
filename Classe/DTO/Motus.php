<?php

namespace TpMotus\DTO;

class Motus
{
    private MotDAO $motDAO;
    private string $mot;

    public function __construct(MotDAO $motDAO)
    {
        $this->motDAO = $motDAO;
    }

    public function jouer()
    {
        $cibleMot = $this->motDAO->MotAleatoire();
        $this->mot = $cibleMot->getMot();
        $longueurMot = mb_strlen($this->mot);

        echo "Motus\n";

        while (true) {
            $tentative = $this->choixUtilisateur($longueurMot);
            $essai = $this->essai($tentative);

            echo "Résultat : $essai\n";

            if ($tentative === $this->mot) {
                echo "Bravo ! Vous avez trouvé le mot : " . ucfirst($this->mot) . "\n";
                break;
            } else {
                echo "Essayez encore.\n";
            }
        }
    }

    private function choixUtilisateur(int $longueur): string
    {
        while (true) {
            $reponse = strtolower(readline("Mot (" . $longueur . " lettres) : "));
            if (mb_strlen($reponse) == $longueur) {
                return $reponse;
            }
            echo "Le mot fait " . $longueur . " lettres.\n";
        }
    }

    public function essai(string $tentative): string
    {
        $essai = "";
        $longMot = mb_strlen($this->mot);
        $marqMot = array_fill(0, $longMot, false);
        $marqTentative = array_fill(0, $longMot, false);

        //1ère étape : marquer les lettres correctes qui sont au même endroit que le mot à trouver
        for ($i = 0; $i < $longMot; $i++) {
            if (mb_substr($tentative, $i, 1) === mb_substr($this->mot, $i, 1)) {
                $essai .= mb_strtoupper(mb_substr($tentative, $i, 1));
                $marqMot[$i] = true;
                $marqTentative[$i] = true;
            } else {
                $essai .= "*";
            }
        }

        //2ème étape : marquer les lettres correctes entre parenthèses car elles sont mal placées
        for ($i = 0; $i < $longMot; $i++) {
            if (!$marqTentative[$i]) {
                $lettreTentative = mb_substr($tentative, $i, 1);

                for ($j = 0; $j < $longMot; $j++) {
                    if (!$marqMot[$j] && $lettreTentative === mb_substr($this->mot, $j, 1)) {
                        $essai = mb_substr($essai, 0, $i) . '(' . $lettreTentative . ')' . mb_substr($essai, $i + 1);
                        $marqMot[$j] = true;
                        break;
                    }
                }
            }
        }

        return $essai;
    }
}
