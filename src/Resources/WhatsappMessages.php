<?php

namespace Ourvoice\Resources;

use Ourvoice\Common\HttpClient;
use Ourvoice\Exceptions;
use Ourvoice\Objects;

/**
 * Class WhatsappMessages
 *
 * @package Ourvoice\Sdk\Resources
 */
class WhatsappMessages extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new Objects\WhatsappMessage();
        $this->setResourceName('whatsapp/messages');

        parent::__construct($httpClient);
    }

    /**
     * List the messages of a given WhatsApp session.
     */
    public function getSessionMessages(string $sessionId, ?array $parameters = [])
    {
        $originalResourceName = $this->resourceName;
        $this->setResourceName($originalResourceName . '/' . $sessionId . '/session');

        try {
            return $this->getList($parameters);
        } finally {
            $this->setResourceName($originalResourceName);
        }
    }

    /**
     * Send a WhatsApp message. The response wraps the sent messages together with
     * cost/balance information, so it is decoded as-is instead of being forced
     * into the WhatsappMessage object.
     */
    public function send(array $params)
    {
        $body = json_encode($params, \JSON_THROW_ON_ERROR);

        [$status, $responseBody] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            $this->resourceName,
            null,
            $body
        );

        if ($responseBody === null) {
            throw new Exceptions\ServerException('Got an invalid JSON response from the server.');
        }

        return json_decode($responseBody, null, 512, \JSON_THROW_ON_ERROR);
    }
}
