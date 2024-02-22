<?php

namespace Rsudipodev\BridgingSatusehatv1\Bridge;

use Rsudipodev\BridgingSatusehatv1\Foundation\Http\OAuth2Client;
use Rsudipodev\BridgingSatusehatv1\Foundation\Handler\CurlFactory;
use Rsudipodev\BridgingSatusehatv1\Foundation\Http\ConfigSatusehat;

class SatusehatPlayground extends CurlFactory
{
    protected $auth;
    protected $access_token;
    protected $config;
    protected $endpointAuth = "/accesstoken?grant_type=client_credentials";

    public function __construct()
    {
        $this->config = new ConfigSatusehat;
        $this->auth = new OAuth2Client($this->config->setUrlAuth() . $this->endpointAuth, $this->config->setCredentials());
        $this->access_token = $this->auth->setToken();
    }

    public function playgroud($endpoint, $method, $payload)
    {
        $result = $this->request($endpoint, $method, $payload, $this->access_token);
        return $result;
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getRequest($endpoint)
    {
        $respon = $this->makeRequest($endpoint, "GET");
        return $respon;
    }

    public function postRequest($endpoint, $data)
    {
        return $this->makeRequest($endpoint, "POST", $data);
    }

    public function putRequest($endpoint, $data)
    {
        return $this->makeRequest($endpoint, "PUT", $data);
    }

    public function textRequest($endpoint, $data)
    {
        return $this->makeRequest($endpoint, "POST", $data, "text/plain");
    }

    protected function makeRequest($endpoint, $method = "POST", $payload = "")
    {
        $result = $this->request($endpoint, $method, $payload, $this->access_token);
        return $result;
    }
}
