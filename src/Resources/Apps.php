<?php

namespace Ourvoice\Resources;

use Ourvoice\Common\HttpClient;
use Ourvoice\Objects;

/**
 * Class Apps
 *
 * @package Ourvoice\Sdk\Resources
 */
class Apps extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new Objects\App();
        $this->setResourceName('apps');

        parent::__construct($httpClient);
    }
}
