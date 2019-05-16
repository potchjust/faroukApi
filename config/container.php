<?php
/**
 * pour l'injection de dépendance
 */
$container = $app->getContainer();

/**
 * Database container
 */
$container['pdo'] = function ($container): PDO {
    $pdo = new PDO('mysql:dbname=farouk_defi;host=localhost', 'root', '', [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
    return $pdo;
};
$container['db'] = function ($container): \Api\Utils\Database {
    return new \Api\Utils\Database($container->pdo);
};


?>
