<?php

namespace Rsudipodev\BridgingSatusehatv1\Bridge;

use Rsudipodev\BridgingSatusehatv1\Foundation\Http\OAuth2Client;
use Rsudipodev\BridgingSatusehatv1\Foundation\Handler\GuzzleFactory;
use Rsudipodev\BridgingSatusehatv1\Foundation\Http\ConfigSatusehat;

class SatusehatPlayground extends GuzzleFactory
{
    protected $auth;
    protected $access_token;
    protected $config;
    protected $endpointAuth = "/accesstoken?grant_type=client_credentials";

    public function __construct()
    {
        $this->config = new ConfigSatusehat;
        $this->auth = new OAuth2Client($this->config->setUrlAuth() . $this->endpointAuth, $this->config->setCredentials());
        $this->access_token = $this->auth->getToken();
    }

    public function playgroud($endpoint, $method, $payload = "")
    {
        $result = $this->makeRequest($endpoint, $method, $payload);
        return json_encode($result, JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES);
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getRequest($endpoint)
    {
        $respon = $this->makeRequest($endpoint, "GET");
        return json_encode($respon, JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES);
    }

    public function postRequest($endpoint, $data)
    {
        return json_encode($this->makeRequest($endpoint, "POST", $data), JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES);
    }

    public function putRequest($endpoint, $data)
    {
        return json_encode($this->makeRequest($endpoint, "PUT", $data), JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES);
    }

    public function textRequest($endpoint, $data)
    {
        return json_encode($this->makeRequest($endpoint, "POST", $data, "text/plain"), JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES);
    }

    protected function makeRequest($endpoint, $method = "POST", $payload = "")
    {
        $result = $this->request($endpoint, $method, $payload, $this->access_token);
        return $result;
    }
}
