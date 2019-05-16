<?php
require '../vendor/autoload.php';
require 'config.php';
/**
 * fichier de lancement
 */
$app = new \Slim\App([
    "settings" => [
        'displayErrorDetails' => true
    ]
]);
require 'container.php';
?>
