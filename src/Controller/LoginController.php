<?php

namespace Api\Controller;

use Api\Model\User;
use Api\Utils\Database;
use http\Client;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController extends BaseController
{
    /**
     * @var Database
     */
    private $database;


    /**
     * @return Database
     */
    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function login(Request $request, Response $response)
    {
        $user = $this->getContainer()->db->prepare('select * from Users where email=? and password=?',
            [$request->getParam('email'), $request->getParam('password')], User::class);
        if ($user) {
            $id = $user->id;
            if ($this->getContainer()->db->prepare('select * from Client where id=?', [$id],
                \Api\Model\Client::class)) {
                $user->type = 'client';
            } elseif ($this->getContainer()->db->prepare('select * from Seller where id=?', [$id],
                \Api\Model\Seller::class)) {
                $user->type = 'seller';
            }
        }
        return $response->withJson($user);
    }
}
