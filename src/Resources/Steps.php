<?php

namespace Ourvoice\Resources;

use Ourvoice\Common\HttpClient;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Steps extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new Objects\Step();
        $this->setResourceName('steps');

        parent::__construct($httpClient);
    }
}
