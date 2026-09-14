<?php

namespace Ourvoice\Resources;

use Ourvoice\Common\HttpClient;
use Ourvoice\Exceptions;
use Ourvoice\Objects;

/**
 * Class Otp
 *
 * @package Ourvoice\Sdk\Resources
 */
class Otp extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new Objects\Otp();
        $this->setResourceName('otp');

        parent::__construct($httpClient);
    }

    /**
     * Send an OTP code to a phone number.
     *
     * @param array $params app_id or app_name, send_to
     */
    public function send(array $params)
    {
        $body = json_encode($params, \JSON_THROW_ON_ERROR);

        [$status, $responseBody] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            $this->resourceName . '/send',
            null,
            $body
        );

        return $this->processRequest($status, $responseBody);
    }

    /**
     * Verify an OTP code.
     *
     * The verify endpoint returns a `success`/`valid` envelope around the OTP
     * record, so it is decoded as-is instead of being forced into the Otp object.
     *
     * @param array $params app_id or app_name, send_to, code
     */
    public function verify(array $params)
    {
        $body = json_encode($params, \JSON_THROW_ON_ERROR);

        [$status, $responseBody] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            $this->resourceName . '/verify',
            null,
            $body
        );

        if ($responseBody === null) {
            throw new Exceptions\ServerException('Got an invalid JSON response from the server.');
        }

        return json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
    }
}
