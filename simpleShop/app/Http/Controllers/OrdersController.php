<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrdersController extends Controller
{
    private $httpClient;
    private $apiEndpoint;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->apiEndpoint = $_ENV['API_ENDPOINT'];
    }

    public function index()
    {
        return view('orders.orders');
    }

    public function saveOrderDetails(Request $request) : JsonResponse
    {
        $orderId = (int) $request->request->get('orderId');
        $editedStatus = (int) $request->request->get('editedStatus');
        $editedModifiedAt = (string) $request->request->get('editedModifiedAt');

        try {
            $result = $this->httpClient->post($this->apiEndpoint, [
                'form_params' => [
                    'report' => 'saveOrderDetails',
                    'orderId' => $orderId,
                    'editedStatus' => $editedStatus,
                    'editedModifiedAt' => $editedModifiedAt
                ]
            ]);
            return new JsonResponse("ok");
        } catch (\Exception $e) {
            return new JsonResponse("error");
        }
    }

    public function getOrdersList(Request $request) : JsonResponse
    {
        $dateFrom = (string) $request->request->get('dateFrom');
        $dateTo = (string) $request->request->get('dateTo');
        $clientType = (int) $request->request->get('clientType');

        $result = $this->httpClient->post($this->apiEndpoint, [
            'form_params' => [
                'report' => 'orders',
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'clientType' => $clientType
            ]
        ]);
        return new JsonResponse($result->getBody()->getContents());
    }
}
