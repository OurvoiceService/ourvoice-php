<?php

namespace Ourvoice\Sdk\Objects;

/**
 * Class Message
 *
 * @package Ourvoice\Sdk\Objects
 */
class Message extends Base
{
    public $account_id;

    public $from;

    public $direction;

    public $body;

    protected $to;

    public $status;

    public $cost;

    protected $id;
}
