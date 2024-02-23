<?php

namespace Rsudipodev\BridgingSatusehatv1\Foundation\Http;

use Dotenv\Dotenv;
use Rsudipodev\BridgingSatusehatv1\Utility\Constant;
use Rsudipodev\BridgingSatusehatv1\Utility\Enviroment;

class ConfigSatusehat
{
    protected $urlAuth;
    protected $urlBase;
    protected $urlConsent;
    protected $urlKfa;
    protected $urlKyc;
    protected $organizationId;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->loadEnvironmentVariables();

        $this->urlAuth = Constant::getAuthUrl();
        $this->urlBase = Constant::getBaseUrl();
        $this->urlConsent = Constant::getConsentUrl();
        $this->urlKfa = Constant::getKfaUrl();
        $this->urlKyc = Constant::getKycUrl();
        $this->organizationId = Enviroment::organizationId();
        $this->clientId = Enviroment::clientId();
        $this->clientSecret = Enviroment::clientSecret();
    }

    protected function loadEnvironmentVariables()
    {
        $dotenv = Dotenv::createImmutable(getcwd());
        $dotenv->safeLoad();
    }

    public function getUrlAuth()
    {
        return $this->urlAuth;
    }

    public function getUrlBase()
    {
        return $this->urlBase;
    }

    public function getUrlConsent()
    {
        return $this->urlConsent;
    }

    public function getUrlKfa()
    {
        return $this->urlKfa;
    }

    public function getUrlKyc()
    {
        return $this->urlKyc;
    }

    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function getCredentials()
    {
        return http_build_query([
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret
        ]);
    }
}
