<?php

declare(strict_types=1);

abstract class AbstractProvider
{
    protected $pdoConnection;

    public function __construct()
    {
        $databaseManager = new DatabaseManager($_ENV['server'], $_ENV['database'], $_ENV['username'], $_ENV['password']);
        $this->pdoConnection = $databaseManager->getConnection();
    }
}