<?php

declare(strict_types=1);

class OrdersManager extends AbstractProvider
{
    public function setOrderDetails(int $orderId, int $editedStatus, string $editedModifiedAt) : void 
    {
        $stmt = $this->pdoConnection->prepare("UPDATE orders SET status_id = :statusId, modified_at = :modifiedAt WHERE id = :orderId");
        $stmt->bindValue('statusId', $editedStatus);
        $stmt->bindValue('modifiedAt', $editedModifiedAt);
        $stmt->bindValue('orderId', $orderId);
        $stmt->execute();

        $stmt->closeCursor();
    }
}
