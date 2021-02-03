<?php 

namespace App;

use Exception;

require __DIR__.'/../vendor/autoload.php';

// https://www.php.net/manual/fr/class.exception.php
// https://www.php.net/manual/fr/language.exceptions.php    
function myLoop(int $max, int $limit): void 
{
    for ($i = 0; $i < $max; $i++) {
        echo "$i<br>";
        
        if ($i == $limit) {
            throw new Exception("le 5ème tour est passé");
            // Exception générale, d'autres noms existent plus spécifiques
        }
    }
}

try{
    myLoop(10, 5);
} catch (Exception $e) {
    // normalement on ajoute ca dans les logs,
    // pas sur l'ecran
    echo "{$e->getMessage()}<br>";
    echo "{$e->getFile()}<br>";
    echo "{$e->getLine()}<br>";
    echo "{$e->getCode()}<br>";
    echo "{$e->getTraceAsString()}<br>";
    dump($e->getTrace());

    // redirection vers une autre page 
    // header('Location: error500.html')
    // exit()
} finally {
    echo "ce texte s'affiche qu'il y ait exception ou pas !<br>";
}
