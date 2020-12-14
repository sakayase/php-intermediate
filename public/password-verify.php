<?php

use Symfony\Component\Yaml\Yaml;

require_once __DIR__.'/../vendor/autoload.php';

$config = Yaml::parseFile(__DIR__.'/../config/config.yaml');

$password = '123';

if (!password_verify($password, $config['password'])) {
    echo 'Le mdp ou le login est mauvais';
}