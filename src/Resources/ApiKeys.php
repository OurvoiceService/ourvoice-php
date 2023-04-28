<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class ApiKeys
 *
 * @package Ourvoice\Sdk\Resources
 */
class ApiKeys extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\ApiKey();
        $this->setResourceName('api-keys');

        parent::__construct($httpClient);
    }
}
