<?php

namespace Ourvoice\Objects;

/**
 * Class WhatsappSession
 *
 * @package Ourvoice\Sdk\Objects
 */
class WhatsappSession extends Base
{
    public $id;

    public $account_id;

    public $session_id;

    public $phone_number;

    public $display_name;

    public $status;

    public $reason;

    public $qr_code;

    public $last_seen_at;

    public $created_at;

    public $updated_at;
}
