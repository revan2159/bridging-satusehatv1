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
    protected $token;
    protected $header;
    protected $timestamps;

    public function __construct()
    {
        $dotenv = Dotenv::createUnsafeImmutable(getcwd());
        $dotenv->safeLoad();


        $this->urlAuth = Constant::getAuthUrl();
        $this->urlBase = Constant::getBaseUrl();
        $this->urlConsent = Constant::getConsentUrl();
        $this->urlKfa = Constant::getKfaUrl();
        $this->urlKyc = Constant::getKycUrl();
        $this->organizationId = Enviroment::organizationId();
        $this->clientId = Enviroment::clientId();
        $this->clientSecret = Enviroment::clientSecret();
    }

    public function setUrlAuth()
    {
        return $this->urlAuth;
    }

    public function setUrlBase()
    {
        return $this->urlBase;
    }

    public function setUrlConsent()
    {
        return $this->urlConsent;
    }

    public function setUrlKfa()
    {
        return $this->urlKfa;
    }

    public function setUrlKyc()
    {
        return $this->urlKyc;
    }

    public function setOrganizationId()
    {
        return $this->organizationId;
    }

    public function setClientId()
    {
        return $this->clientId;
    }

    public function setClientSecret()
    {
        return $this->clientSecret;
    }

    public function setCredentials()
    {
        $data = [
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret
        ];
        return http_build_query($data);
    }
}
