<?php

namespace Fw\Component\Databases\MysqlPDO;

use \PDOException;
use \PDO;

class MysqlPDOConnection {

    private $dsn;
    private $user;
    private $password;
    private $options;
    private $pdo;


    public function __construct($database) {


        $this->dsn = $database['driver'].':host='.$database['host'].';dbname='.$database['database'];
        $this->user = $database['username'];
        $this->password = $database['password'];

        try {

            $this->pdo = new PDO($this->dsn, $this->user, $this->password);


        } catch (PDOException $e) {

            echo 'Connection Error ' . $e->getMessage();

        }

        return $this->pdo;

    }


}