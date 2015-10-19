<?php

namespace Fw\Component\Databases\MysqlPDO;

use Fw\Component\Databases\Database;
use \PDOException;
use \PDO;

class MysqlPDOConnection extends PDO implements Database {

    protected  $dsn;
    protected $user;
    protected $password;
    protected $options;
    public $pdo;


    public function __construct($database) {

        $this->dsn = $database['driver'].':host='.$database['host'].';dbname='.$database['database'].';charset='.$database['charset'];
        $this->user = $database['username'];
        $this->password = $database['password'];

        try {

            $this->pdo = new PDO($this->dsn, $this->user, $this->password);

            $this->pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );

            $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            return $this->pdo;


        } catch (PDOException $e) {

            echo 'Connection Error ' . $e->getMessage();

        }

    }

}