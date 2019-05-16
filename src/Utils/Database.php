<?php

namespace Api\Utils;

use PDO;
use Slim\Container;

class Database
{

    /**
     * @var Container
     */
    private $container;
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function query($stmt, $class)
    {
        $request = $this->pdo->query($stmt);
        $datas = $request->fetchAll(PDO::FETCH_CLASS, $class);
        return $datas;
    }

    public function prepare($stmt, $params, $class)
    {
        $request = $this->pdo->prepare($stmt);
        $request->execute($params);
        $request->setFetchMode(PDO::FETCH_CLASS, $class);
        $datas = $request->fetch();
        return $datas;
    }

}
