<?php

namespace App\Model;


class DB extends \PDO
{
    public function __construct($dsn = null, $username = null, $password = null, $options = array())
    {
        $dsn = ($dsn != null) ? $dsn : sprintf('mysql:dbname=%s;host=%s', DB_NAME, DB_HOST);
        $username = ($username != null) ? $username : DB_USER;
        $password = ($password != null) ? $password : DB_PASS;
        
        parent::__construct($dsn, $username, $password, $options);
    }
}
