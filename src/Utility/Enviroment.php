<?php

namespace Rsudipodev\BridgingSatusehatv1\Utility;


class Enviroment
{
    public static function authUrl(): string
    {
        $authUrl = getenv('SATUSEHAT_AUTH') ?? config('satusehat.auth_url');

        if (!$authUrl) {
            throw new \RuntimeException("Satusehat Auth URL not found in Enviroment");
        }

        return $authUrl;
    }

    public static function baseUrl(): string
    {
        $baseUrl = getenv('SATUSEHAT_BASE') ?? config('satusehat.base_url');

        if (!$baseUrl) {
            throw new \RuntimeException("Satusehat Base URL not found in Enviroment");
        }

        return $baseUrl;
    }

    public static function consentUrl(): string
    {
        $consentUrl = getenv('SATUSEHAT_CONSENT') ?? config('satusehat.consent_url');

        if (!$consentUrl) {
            throw new \RuntimeException("Satusehat Consent URL not found in Enviroment");
        }

        return $consentUrl;
    }

    public static function kfaUrl(): string
    {
        $kfaUrl = getenv('SATUSEHAT_KFA') ?? config('satusehat.kfa_url');

        if (!$kfaUrl) {
            throw new \RuntimeException("Satusehat KFA URL not found in Enviroment");
        }

        return $kfaUrl;
    }

    public static function kycUrl(): string
    {
        $kycUrl = getenv('SATUSEHAT_KYC') ?? config('satusehat.kyc_url');

        if (!$kycUrl) {
            throw new \RuntimeException("Satusehat KYC URL not found in Enviroment");
        }

        return $kycUrl;
    }


    public static function clientId(): string
    {
        $clientId = getenv('SATUSEHAT_CLIENTID') ?? config('satusehat.client_id');

        if (!$clientId) {
            throw new \RuntimeException("Satusehat Client ID not found in Enviroment");
        }

        return $clientId;
    }

    public static function clientSecret(): string
    {
        $clientSecret = getenv('SATUSEHAT_CLIENTSECRET') ?? config('satusehat.client_secret');

        if (!$clientSecret) {
            throw new \RuntimeException("Satusehat Client Secret not found in Enviroment");
        }

        return $clientSecret;
    }

    public static function organizationId(): string
    {
        $organizationId = getenv('SATUSEHAT_ORGID') ?? config('satusehat.organization_id');

        if (!$organizationId) {
            throw new \RuntimeException("Satusehat Organization ID not found in Enviroment");
        }

        return $organizationId;
    }
}
