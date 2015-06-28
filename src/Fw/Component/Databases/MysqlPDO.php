<?php

namespace Fw\Component\Databases;

use Fw\Component\Databases\Database;
use Fw\Component\Databases\Mysql;
use \PDO;

class MysqlPDO implements Database, Mysql {

    private $mysqlpdo;

    public function __construct(PDO $pdo) {

        $this->mysqlpdo = $pdo;

    }



}
