<?php
/*
 * fichier de routing des api
 */

$app->post('/api/login', '\Api\Controller\LoginController:login');
$app->post('/api/service/add', '\Api\Controller\ServicesController:insert');
$app->get('/api/service/all', '\Api\Controller\ServicesController:getAllServices');
$app->get('/api/service/show/{serviceId}', '\Api\Controller\ServicesController:show');

?>
