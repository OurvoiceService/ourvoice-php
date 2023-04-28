<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Roles
 *
 * @package Ourvoice\Sdk\Resources
 */
class Roles extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Role();
        $this->setResourceName('roles');

        parent::__construct($httpClient);
    }
}