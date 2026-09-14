<?php

namespace Ourvoice\Objects;

/**
 * Class Messages
 *
 * @package Ourvoice\Sdk\Objects
 */
class Message extends Base
{
    public $account_id;

    public $from;

    public $direction;

    public $body;

    public $to;

    public $status;

    public $cost;

    public $currency;

    public $contact_id;

    public $campaign_id;

    public $flow_id;

    public $sender_id;

    public $sender_name;

    public $otp_id;

    public $created_at;

    public $updated_at;

    public $id;
}
