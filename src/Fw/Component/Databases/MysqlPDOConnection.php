<?php

namespace Fw\Component\Databases;

use Fw\Component\Databases\MysqlPDO;
use \PDO;

class MysqlPDOConnection {

    private $dsn;
    private $user;
    private $password;
    private $options;


    public function __construct($database) {


        $this->dsn = $database['driver'].':host='.$database['host'].';dbname='.$database['database'];
        $this->user = $database['user'];
        $this->password = $database['password'];

        try {
            $pdo = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Connection Error ' . $e->getMessage();
        }



    }


}