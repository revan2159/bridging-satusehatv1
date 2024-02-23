<?php

namespace Rsudipodev\BridgingSatusehatv1\Bridge;

use Rsudipodev\BridgingSatusehatv1\Foundation\Http\OAuth2Client;
use Rsudipodev\BridgingSatusehatv1\Foundation\Handler\GuzzleFactory;
use Rsudipodev\BridgingSatusehatv1\Foundation\Http\ConfigSatusehat;

class SatusehatConsent extends GuzzleFactory
{
    protected $auth;
    protected $access_token;
    protected $config;
    protected $endpointAuth = "/accesstoken?grant_type=client_credentials";

    public function __construct()
    {
        $this->config = new ConfigSatusehat;
        $this->auth = new OAuth2Client($this->config->getUrlAuth() . $this->endpointAuth, $this->config->getCredentials());
        $this->access_token = $this->auth->getToken();
    }
    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getRequest($endpoint)
    {
        $respon = $this->makeRequest($this->config->getUrlConsent() . $endpoint, "GET");
        return $respon;
    }

    public function postRequest($endpoint, $data)
    {
        return $this->makeRequest($this->config->getUrlConsent() . $endpoint, "POST", $data);
    }

    public function putRequest($endpoint, $data)
    {
        return $this->makeRequest($this->config->getUrlConsent() . $endpoint, "PUT", $data);
    }
    // for text/plain
    public function textRequest($endpoint, $data)
    {
        return $this->makeRequest($this->config->getUrlConsent() . $endpoint, "POST", $data, "text/plain");
    }

    protected function makeRequest($endpoint, $method = "POST", $payload = "")
    {
        $result = $this->request($endpoint, $method, $payload, $this->access_token);
        return $result;
    }
}
