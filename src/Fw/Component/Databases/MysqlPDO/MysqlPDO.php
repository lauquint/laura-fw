<?php

namespace Fw\Component\Databases\MysqlPDO;

use Fw\Component\Databases\Database;
use Fw\Component\Databases\Mysql;
use \PDO;

class MysqlPDO implements Database, Mysql {

    public $database;


    public function __construct(PDO $pdo) {

        $this->database = $pdo;

    }


}
