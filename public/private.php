<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Symfony\Component\Yaml\Yaml;

// activation du système d'autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// demarrage de la session
session_start(); //pour avoir la variable de session

// instanciation du chargeur de templates
$loader = new FilesystemLoader(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new Environment($loader);

// traitement des données
if (!isset($_SESSION['login'])) {
    // l'utilisateur ne peut acceder à la page
    $url = '/';
    header("location: {$url}", true, 301);
    exit();
}

// affichage du rendu d'un template
echo $twig->render('private.html.twig', [
    // transmission de données au template
    'login' => $_SESSION['login'],
    'email' => $_SESSION['email'],
]);
