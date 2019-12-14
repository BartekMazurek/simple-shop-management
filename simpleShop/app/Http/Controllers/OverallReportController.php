<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OverallReportController extends Controller
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
        return view('overall.overall');
    }

    public function report(Request $request) : JsonResponse
    {
        $dateFrom = (string) $request->request->get('dateFrom');
        $dateTo = (string) $request->request->get('dateTo');

        $result = $this->httpClient->post($this->apiEndpoint, [
            'form_params' => [
                'report' => 'overall',
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo
            ]
        ]);
        return new JsonResponse($result->getBody()->getContents());
    }
}
