<?php

class Database
{
    // properties — DB params
    private $host = "localhost";
    private $port = 3306;
    private $db_name = "myblog";
    private $username = "qais";
    private $password = "123456";
    private $conn;

    // methods:
    // Connect to Database

    public function connect()
    {
        $this->conn = "null";

        // try catch
        try {
            // PDO() takes in some arguments. ex: mysql, as we can use other kind of databases with PDO
//            $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db_name", "$this->username", "$this->password");

            // set error mode so we: get exceptions when we make query in case something goes wrong it will tell us whats going on
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // getMessage will tell us excatcly what is going on if it does not connect
            echo 'connection error: ' . $e->getMessage();
        }

        // return conn
        return $this->conn;
    }

    // test function
    public function test()
    {
        return "hello world";
    }
}
