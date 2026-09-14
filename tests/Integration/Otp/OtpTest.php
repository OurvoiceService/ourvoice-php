<?php

namespace Tests\Integration\Otp;

use Tests\Integration\BaseTest;

class OtpTest extends BaseTest
{
    public function testSendOtp(): void
    {
        $params = ['app_name' => 'my_app', 'send_to' => '22912121212'];

        $this->mockClient
            ->expects($this->once())->method('performHttpRequest')
            ->with('POST', 'otp/send', null, json_encode($params, \JSON_THROW_ON_ERROR))
            ->willReturn([200, '{
                "id": "otp_id",
                "app_id": "app_id",
                "status": "pending",
                "channel": "sms",
                "send_to": "22912121212"
            }']);

        $otp = $this->client->otp->send($params);
        self::assertSame('pending', $otp->status);
    }

    public function testVerifyOtp(): void
    {
        $params = ['app_name' => 'my_app', 'send_to' => '22912121212', 'code' => 123456];

        $this->mockClient
            ->expects($this->once())->method('performHttpRequest')
            ->with('POST', 'otp/verify', null, json_encode($params, \JSON_THROW_ON_ERROR))
            ->willReturn([200, '{
                "success": true,
                "valid": true,
                "message": "Code verified",
                "data": {"id": "otp_id", "status": "verified"}
            }']);

        $result = $this->client->otp->verify($params);
        self::assertTrue($result->valid);
        self::assertSame('verified', $result->data->status);
    }
}
