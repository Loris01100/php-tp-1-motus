<?php

require_once __DIR__ . '/vendor/autoload.php';
function MotAleatoire($words)
{
    return strtolower($words[array_rand($words)]);
}

function choixUti($longeur)
{
    while (true) {
        $response = strtolower(readline("Mot (" . $longeur . " lettres) : "));
        if (strlen($response) == $longeur) {
            return $response;
        }
        echo "Le mot fait " . $longeur . " lettres.\n";
    }
}

// Function to give feedback on the guessed word
function getFeedback($response, $targetWord)
{
    $feedback = "";
    $markedLetters = [];
    $wordLength = strlen($targetWord);

    // Check for correct letters in the correct positions
    for ($i = 0; $i < $wordLength; $i++) {
        if ($response[$i] == $targetWord[$i]) {
            $feedback .= strtoupper($response[$i]);
            $markedLetters[$i] = true;
        } else {
            $markedLetters[$i] = false;
        }
    }

    // Check for correct letters in incorrect positions
    for ($i = 0; $i < $wordLength; $i++) {
        if (!$markedLetters[$i]) {
            if (strpos($targetWord, $response[$i]) !== false && substr_count($response, $response[$i]) <= substr_count($targetWord, $response[$i])) {
                $feedback .= "(" . $response[$i] . ")";
            } else {
                $feedback .= "*";
            }
        }
    }

    return $feedback;
}

// Function to play the game
function playMotus($words)
{
    $targetWord = MotAleatoire($words);
    $wordLength = strlen($targetWord);

    echo "Motus\n";

    while (true) {
        $response = choixUti($wordLength);
        $feedback = getFeedback($response, $targetWord);

        echo "Résultat : $feedback\n";

        if ($response === $targetWord) {
            echo "Bravo ! Vous avez trouvé le mot : " . ucfirst($targetWord) . "\n";
            break;
        } else {
            echo "Essayez encore.\n";
        }
    }
}

// Array of words for the game
$words = ["Peche", "Camion", "Banane", "Voiture", "Douche", "Gymnastique"];

// Start the game
playMotus($words);


