<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Common\HttpClient;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Account extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Account();
        $this->setResourceName('accounts');

        parent::__construct($httpClient);
    }
    public function getAccountBalance() {
        $resourceName =  'current/balance/';

        [$responseStatus, , $responseBody] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_GET,
            $resourceName,
            false
        );
        if ($responseStatus == HttpClient::HTTP_SUCCESS) {
            $response = json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
            return $response->data->balance;
        }
    }
}
