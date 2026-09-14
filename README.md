# Ourvoice's REST API for PHP

This repository contains the open source PHP client for Ourvoice's REST API.
Documentation can be found at: https://api-docs.getourvoice.com/

## Requirements

-   [Sign up](https://app.getourvoice.com/auth/register) for a free Ourvoice account
-   Create a new access_key in the developers sections
-   Ourvoice API client for PHP requires PHP >= 7.4.

## Installation

#### Composer installation

-   [Download composer](https://getcomposer.org/doc/00-intro.md#installation-nix)
-   Run `composer require ourvoice/ourvoice-php`.

#### Manual installation

When you do not use Composer. You can git checkout or download [this repository](https://github.com/OurvoiceService/ourvoice-php) and include the Ourvoice API client manually.

## Usage

Here is a quick breakdown on how it works. First, you need to set up a **Ourvoice\Client**. Be sure to replace **YOUR_ACCESS_KEY** with something real.

```php

$ourvoice = new \Ourvoice\Client('YOUR_API_KEY');

```

That's easy enough. Now we can query the server for information. Lets use getting your campaigns overview as an example:

```php
// Get your campaigns
$myCampaigns = $ourvoice->campaigns->getList();
```

## Available resources

`$ourvoice->account`, `$ourvoice->apps`, `$ourvoice->campaigns`, `$ourvoice->contacts`,
`$ourvoice->flows`, `$ourvoice->groups`, `$ourvoice->medias`, `$ourvoice->messages`,
`$ourvoice->numbers`, `$ourvoice->otp`, `$ourvoice->steps`, `$ourvoice->subscriptions`,
`$ourvoice->voices`, `$ourvoice->webhooks`, `$ourvoice->whatsappSessions`,
`$ourvoice->whatsappMessages`.

A few examples beyond basic CRUD:

```php
// Send a voice call
$ourvoice->voices->sendCall([
    'to' => ['22912121212'],
    'audio_url' => 'https://example.com/audio.mp3',
    'phone_number' => '22900000000',
]);

// Send and verify an OTP code
$ourvoice->otp->send(['app_name' => 'my_app', 'send_to' => '22912121212']);
$ourvoice->otp->verify(['app_name' => 'my_app', 'send_to' => '22912121212', 'code' => 123456]);

// Check and top up your account balance
$balance = $ourvoice->account->getAccountBalance();
$ourvoice->account->topUpBalance([
    'amount' => 1000,
    'payment_id' => 'payment_id',
    'payment_method' => 'card',
    'status' => 'success',
]);

// Create a WhatsApp session and send a message
$session = $ourvoice->whatsappSessions->create();
$ourvoice->whatsappMessages->send([
    'whatsapp_session_id' => 'session_id',
    'to_number' => ['22912121212'],
    'type' => 'text',
    'content' => 'Hello!',
]);
```

## Documentation

Complete documentation, instructions, and examples are available at:
[https://api-docs.getourvoice.com/](https://api-docs.getourvoice.com/)

## License

The Ourvoice REST Client for PHP is licensed under [The MIT License](https://opensource.org/license/mit-0/). Copyright (c) 2023, Ourvoice
