<?php

declare(strict_types=1);

class OrdersListProvider extends AbstractProvider
{
    public function getData(string $dateFrom, string $dateTo, int $clientType) : ?array
    {
        $stmt = $this->pdoConnection->prepare("CALL getOrdersList(?, ?, ?)");
        $stmt->bindValue(1, $dateFrom);
        $stmt->bindValue(2, $dateTo);
        $stmt->bindValue(3, $clientType);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }
}