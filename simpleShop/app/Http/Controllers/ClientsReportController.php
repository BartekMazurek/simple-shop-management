<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ClientsReportController extends Controller
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
        return view('clients.clients');
    }

    public function report(Request $request) : JsonResponse
    {
        $dateFrom = (string) $request->request->get('dateFrom');
        $dateTo = (string) $request->request->get('dateTo');
        $clientType = (int) $request->request->get('clientType');

        $result = $this->httpClient->post($this->apiEndpoint, [
            'form_params' => [
                'report' => 'clients',
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'clientType' => $clientType
            ]
        ]);
        return new JsonResponse($result->getBody()->getContents());
    }
}
