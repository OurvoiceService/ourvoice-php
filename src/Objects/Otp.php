<?php

namespace Ourvoice\Objects;

/**
 * Class Otp
 *
 * @package Ourvoice\Sdk\Objects
 */
class Otp extends Base
{
    public $id;

    public $app_id;

    public $cost;

    public $status;

    public $channel;

    public $send_to;

    public $code;

    public $send_code_attempts;

    public $verification_attemps;

    public $expired_at;

    public $verified_at;

    public $created_at;

    public $updated_at;
}
