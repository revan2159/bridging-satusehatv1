<?php

namespace Rsudipodev\BridgingSatusehatv1\Foundation\Http;

use Illuminate\Support\Facades\Cache;
use Rsudipodev\BridgingSatusehatv1\Foundation\Handler\GuzzleFactory;

class OAuth2Client
{
    protected $bridge;
    protected $accessToken;
    protected $cacheKey = 'oauth2_access_token';

    /**
     * OAuth2Client constructor.
     *
     * @param string $endpoint   The URL to obtain the access token.
     * @param array  $dataClient The client data for authentication.
     */
    public function __construct($endpoint, $dataClient)
    {
        $this->bridge = new GuzzleFactory();

        // Check if access token exists in cache
        if (Cache::has($this->cacheKey)) {
            $cachedToken = Cache::get($this->cacheKey);
            $this->accessToken = $cachedToken['access_token'];
            $expiresAt = $cachedToken['expires_at'];

            // If token is expired, refresh it
            if (strtotime($expiresAt) <= time()) {
                $this->refreshToken($endpoint, $dataClient);
            }
        } else {
            // If token doesn't exist in cache, obtain new token
            $this->obtainToken($endpoint, $dataClient);
        }
    }

    /**
     * Obtain a new access token.
     *
     * @param string $endpoint   The URL to obtain the access token.
     * @param array  $dataClient The client data for authentication.
     * 
     * @throws \RuntimeException If there is an error during the request.
     */
    protected function obtainToken($endpoint, $dataClient)
    {
        $response = $this->bridge->request($endpoint, "POST", $dataClient, null, "application/x-www-form-urlencoded");

        if (isset($response->access_token)) {
            $this->accessToken = $response->access_token;
            $expiresIn = $response->expires_in;

            // Cache the token with expiration time
            $expiresAt = now()->addSeconds($expiresIn);
            Cache::put($this->cacheKey, ['access_token' => $this->accessToken, 'expires_at' => $expiresAt], $expiresAt);
        } else {
            throw new \RuntimeException('Access token not found in the response.');
        }
    }

    /**
     * Refresh the access token.
     *
     * @param string $endpoint   The URL to obtain the access token.
     * @param array  $dataClient The client data for authentication.
     * 
     * @throws \RuntimeException If there is an error during the request.
     */
    protected function refreshToken($endpoint, $dataClient)
    {
        // Obtain new token using refresh token or any other appropriate method
        $this->obtainToken($endpoint, $dataClient);
    }

    /**
     * Get the obtained access token.
     *
     * @return string|null The access token or null if not obtained.
     */
    public function getToken()
    {
        return $this->accessToken;
    }
}
