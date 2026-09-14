<?php

namespace Ourvoice\Objects;

/**
 * Class Campaign
 *
 * @package Ourvoice\Sdk\Objects
 */
class Campaign extends Base
{

    public $account_id;

    public $name;

    public $type;

    /**
     * @deprecated use $group_ids
     */
    public $group_id;

    public $group_ids;

    public $repeat;

    public $start_date;

    public $end_date;

    public $status;

    public $audio_url;

    public $sender_id;

    public $sender_name;

    public $whatsapp_session_id;

    public $whatsapp_message_type;

    public $media_url;

    protected $id;

    public function getId(): ?string
    {
        return $this->id;
    }
}
