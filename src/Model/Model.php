<?php

namespace App\Model;

class Model
{
    public ?\mysqli $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = $this->connectToDatabase();
    }

    public function connectToDatabase()
    {
        $mysqli = new \mysqli("127.0.0.1", "root", "password", "Shop");

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        } else {
            return $mysqli;
        }
    }
}
