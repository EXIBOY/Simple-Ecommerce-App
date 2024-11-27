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
        $mysqli = new \mysqli("mi-linux.wlv.ac.uk", "2402205", "2xaca2laExi_1234*", "db2402205");

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        } else {
            return $mysqli;
        }
    }
}
