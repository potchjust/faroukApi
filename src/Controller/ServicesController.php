<?php

namespace Api\Controller;

use Api\Model\Services;
use Slim\Http\Request;
use Slim\Http\Response;

class ServicesController extends BaseController
{

    public function insert(Request $request, Response $response)
    {
        /**
         * Check the method
         */
        if ($request->getMethod() === 'POST') {
            /**
             * Firstly check if has an existing record in the database
             *
             */
            $service = $this->getContainer()->db->prepare('select * from Services where nom_service=?',
                [$request->getParam('name')], Services::class);
            if ($service) {
                return $response->withJson(['statut' => 'Service avec ce nom déja existant dans nottre système']);
            } else {

                $service = $this->getContainer()->db->prepare('insert into Services set nom_service=?,description_service=?,prix=?,id_seller=?',
                    [
                        $request->getParam('name'),
                        $request->getParam('desc'),
                        $request->getParam('price'),
                        $request->getParam('id_seller')
                    ], Services::class);
                return $response->withJson(['statut' => 'Service ajouté avec succès']);
            }
        }
    }

    public function getAllServices(Request $request, Response $response)
    {
        $services = $this->getContainer()->db->query('select * from Services', Services::class);
        return $response->withJson($services);
    }

    public function show(Request $request, Response $response)
    {
        $service = $this->getContainer()->db->prepare('select * from Services inner join Seller on Services.id_seller = Seller.id_seller inner join Users on Seller.id = Users.id where id_service=?',
            [$request->getAttribute('serviceId')],
            Services::class);
        return $response->withJson($service);
    }
}
