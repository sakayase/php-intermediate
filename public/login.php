<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Symfony\Component\Yaml\Yaml;

use Twig\Extension\DebugExtension;

// activation du système d'autoloading de Composer
require_once __DIR__.'/../vendor/autoload.php';

// demarrage de la session
session_start(); //pour avoir la variable de session

// instanciation du chargeur de templates
$loader = new FilesystemLoader(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new Environment($loader, [
    'debug' => true,
    'strict_variables' => true,
]);

$twig->AddExtension(new DebugExtension());

// traitement des données 
$config = Yaml::parseFile(__DIR__.'/../config/config.yaml');
$data = [
    'password' => '',
    'login' => '',
];
$errors = [];

dump($_POST);
dump($data);

if ($_POST) {
    foreach($data as $key => $value){
        if(isset($_POST[$key])) {
            $data[$key] = $_POST[$key];
        }
    }
    $data['password'] = 'cok';
    if (empty($_POST['login'])) {
        $errors['login'] = 'Veuillez rentrer votre login';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Veuillez rentrer votre mot de passe';
    }
}


// affichage du rendu d'un template
echo $twig->render('login.html.twig', [
    // transmission de données au template
    'errors' => $errors,
    'data' => $data,
]);



// style avec bootstrap
// validation de form d'authentification
// si l'utilisateur est correctement authentifié :
// - son login et son password sont copiés dans la variable de session
// - il est redirigé vers la pahe private.php 
// sinon un message générique est affiché :
// "Mot de passe ou login invalide"

