<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

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
}
