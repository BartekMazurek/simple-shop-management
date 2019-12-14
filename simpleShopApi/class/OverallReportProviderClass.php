<?php

declare(strict_types=1);

class OverallReportProvider extends AbstractProvider
{
    public function getData(string $dateFrom, string $dateTo) : ?array
    {
        $stmt = $this->pdoConnection->prepare("CALL getOverallReport(?, ?)");
        $stmt->bindValue(1, $dateFrom);
        $stmt->bindValue(2, $dateTo);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $result;
    }
}
