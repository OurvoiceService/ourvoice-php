<?php

namespace Ourvoice\Objects;

/**
 * Class WhatsappMessage
 *
 * @package Ourvoice\Sdk\Objects
 */
class WhatsappMessage extends Base
{
    public $id;

    public $whatsapp_session_id;

    public $campaign_id;

    public $otp_id;

    public $provider_message_id;

    public $from_number;

    public $to_number;

    public $type;

    public $content;

    public $media_url;

    public $status;

    public $direction;

    public $reason;

    public $cost;

    public $sent_at;

    public $delivered_at;

    public $read_at;

    public $metadata;

    public $created_at;

    public $updated_at;
}
