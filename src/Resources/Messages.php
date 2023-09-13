<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Common\HttpClient;
use Ourvoice\Objects;

/**
 * Class Messages
 *
 * @package Ourvoice\Sdk\Resources
 */
class Messages extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Message();
        $this->setResourceName('messages');

        parent::__construct($httpClient);
    }

    public function getStats() {
        $resourceName =  'stats/sms/';

        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_GET,
            $resourceName,
            false
        );
        if ($responseStatus == HttpClient::HTTP_SUCCESS) {
            $response = json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
            return $response->data;
        }
    }
}
