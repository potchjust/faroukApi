<?php

namespace Api\Controller;

use Api\Utils\Database;
use PDO;
use Slim\Container;

class BaseController
{

    /**
     * @var Container
     */
    private $container;

    /**
     * @var Container
     */

    public function __construct(Container $container)
    {

        $this->container = $container;
    }


    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }


}
