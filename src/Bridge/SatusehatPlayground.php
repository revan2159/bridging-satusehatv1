<?php

namespace Rsudipodev\BridgingSatusehatv1\Bridge;

use Rsudipodev\BridgingSatusehatv1\Foundation\Http\OAuth2Client;
use Rsudipodev\BridgingSatusehatv1\Foundation\Handler\GuzzleFactory;
use Rsudipodev\BridgingSatusehatv1\Foundation\Http\ConfigSatusehat;

class SatusehatPlayground extends GuzzleFactory
{
    protected $auth;
    protected $accessToken;
    protected $config;
    protected $endpointAuth = "/accesstoken?grant_type=client_credentials";

    public function __construct()
    {
        $this->config = new ConfigSatusehat;
        $this->auth = new OAuth2Client($this->config->getUrlAuth() . $this->endpointAuth, $this->config->getCredentials());
        $this->accessToken = $this->auth->getToken();
    }

    public function playground(string $endpoint, string $method, $payload = ""): string
    {
        $result = $this->makeRequest($endpoint, $method, $payload);
        return json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getRequest(string $endpoint): string
    {
        $response = $this->makeRequest($endpoint, "GET");
        return json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function postRequest(string $endpoint, $data): string
    {
        return json_encode($this->makeRequest($endpoint, "POST", $data), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function putRequest(string $endpoint, $data): string
    {
        return json_encode($this->makeRequest($endpoint, "PUT", $data), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    protected function makeRequest($endpoint, $method = "POST", $payload = "")
    {
        $result = $this->request($endpoint, $method, $payload, $this->accessToken);
        return $result;
    }
}
