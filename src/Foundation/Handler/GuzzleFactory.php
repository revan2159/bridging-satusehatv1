<?php

namespace Rsudipodev\BridgingSatusehatv1\Foundation\Handler;

use Illuminate\Support\Facades\Http;

class GuzzleFactory
{
    const DEFAULT_CONTENT_TYPE = 'application/json';

    /**
     * Make an HTTP request using Illuminate\Http\Client.
     *
     * @param string $endpoint   The URL to send the request to.
     * @param string $method     The HTTP method (GET, POST, PUT, DELETE).
     * @param mixed  $payload    The data to send in the request body.
     * @param string $header     Additional header information.
     * @param string $contentType The content type of the request.
     *
     * @return mixed The response from the server.
     *
     * @throws \RuntimeException If there is an error during the request.
     */
    public function request($endpoint, $method = "POST", $payload = "", $header = null, $contentType = self::DEFAULT_CONTENT_TYPE)
    {
        try {
            $request = Http::withHeaders([
                'User-Agent' => 'RSUDIPODEV/1.0',
                'Content-Type' => $contentType,
                'Accept' => '*/*',
                'Connection' => 'keep-alive',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Authorization' => $header ? 'Bearer ' . $header : null,
            ])->withBody($payload, $contentType);

            switch (strtoupper($method)) {
                case 'GET':
                    $response = $request->get($endpoint);
                    break;
                case 'POST':
                    $response = $request->post($endpoint);
                    break;
                case 'PUT':
                    $response = $request->put($endpoint);
                    break;
                case 'DELETE':
                    $response = $request->delete($endpoint);
                    break;
                default:
                    throw new \InvalidArgumentException("Unsupported HTTP method: $method");
            }

            return $response->object();
        } catch (\Throwable $th) {
            throw new \RuntimeException($th->getMessage());
        }
    }
}
