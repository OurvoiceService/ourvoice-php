<?php

namespace Ourvoice\Resources;

use Ourvoice\Common\HttpClient;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Voices extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new Objects\Voice();
        $this->setResourceName('voices');

        parent::__construct($httpClient);
    }

    /**
     * Send a voice call to a single recipient.
     *
     * @param array $params to, audio_url, and either number_id or phone_number
     */
    public function sendCall(array $params)
    {
        $body = json_encode($params, \JSON_THROW_ON_ERROR);

        [$status, $responseBody] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            'call',
            null,
            $body
        );

        return $this->processRequest($status, $responseBody);
    }

    /**
     * Send a voice call to multiple recipients.
     *
     * @param array $params to (array), audio_url
     */
    public function sendBulkCall(array $params)
    {
        $body = json_encode($params, \JSON_THROW_ON_ERROR);

        [$status, $responseBody] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            'calls',
            null,
            $body
        );

        return $this->processRequest($status, $responseBody);
    }
}
