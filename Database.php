<?php
class Database
{
    public $pdo;
    private $host;
    private $user;
    private $password;
    private $database;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->database = 'eventos';
        $this->connect();
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->user, $this->password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return "ERRO AO SE CONECTAR AO BANCO" . $e->getMessage();
        }
        return $this->pdo;
    }

}

