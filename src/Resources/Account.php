<?php

namespace Ourvoice\Resources;

use Ourvoice\Common\HttpClient;
use Ourvoice\Exceptions;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Account extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new Objects\Account();
        $this->setResourceName('accounts');

        parent::__construct($httpClient);
    }
    public function getAccountBalance() {
        $resourceName =  'current/balance/';

        [$responseStatus, $responseBody] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_GET,
            $resourceName,
            false
        );
        if ($responseStatus == HttpClient::HTTP_SUCCESS) {
            $response = json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
            return $response->data->balance;
        }
    }

    /**
     * Top up the account balance.
     *
     * @param array $params amount, payment_id, payment_method, status
     */
    public function topUpBalance(array $params)
    {
        $body = json_encode($params, \JSON_THROW_ON_ERROR);
        $resourceName = 'transactions/topUpBalance';

        [$responseStatus, $responseBody] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            $resourceName,
            null,
            $body
        );

        if ($responseBody === null) {
            throw new Exceptions\ServerException('Got an invalid JSON response from the server.');
        }

        return json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
    }
}
