<?php

declare(strict_types=1);

class DatabaseManager
{
    private $connection;

    public function __construct(string $servername, string $database, string $username, string $password)
    {
        $this->connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    }

    public function getConnection(): PDO 
    {
        return $this->connection;
    }
}
