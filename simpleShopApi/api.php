<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['report'] === 'overall') {
        $overallReportProvider = new OverallReportProvider();
        echo json_encode($overallReportProvider->getData(DataFilter::filterString($_POST['dateFrom']), DataFilter::filterString($_POST['dateTo'])));
    } elseif ($_POST['report'] === 'clients') {
        $clientsReportProvider = new ClientsReportProvider();
        echo json_encode($clientsReportProvider->getData(DataFilter::filterString($_POST['dateFrom']), DataFilter::filterString($_POST['dateTo']), DataFilter::filterInteger($_POST['clientType'])));
    } elseif ($_POST['report'] === 'orders') {
        $ordersListProvider = new OrdersListProvider();
        echo json_encode($ordersListProvider->getData(DataFilter::filterString($_POST['dateFrom']), DataFilter::filterString($_POST['dateTo']), DataFilter::filterInteger($_POST['clientType'])));
    } elseif ($_POST['report'] === 'saveOrderDetails') {
        $ordersManager = new OrdersManager();
        $ordersManager->setOrderDetails(DataFilter::filterInteger($_POST['orderId']), DataFilter::filterInteger($_POST['editedStatus']), DataFilter::filterString($_POST['editedModifiedAt']));
    }
}