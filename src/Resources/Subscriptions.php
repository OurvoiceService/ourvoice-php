<?php

namespace Ourvoice\Resources;

use Ourvoice\Common\HttpClient;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Subscriptions extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new Objects\Subscription();
        $this->setResourceName('subscriptions');

        parent::__construct($httpClient);
    }
}
