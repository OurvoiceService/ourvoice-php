<?php

namespace Tests\Integration\Whatsapp;

use Ourvoice\Exceptions\ServerException;
use Tests\Integration\BaseTest;

class WhatsappSessionTest extends BaseTest
{
    public function testCreateSession(): void
    {
        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '{
                "success": true,
                "session": {"id": "session_id", "status": "pending"},
                "qr_code": "data:image/png;base64,..."
            }',
        ]);

        $this->client->whatsappSessions->create();
    }

    public function testListSessions(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'whatsapp/sessions',
            [],
            null
        );
        $this->client->whatsappSessions->getList();
    }

    public function testViewSession(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'whatsapp/sessions/session_id',
            null,
            null
        );
        $this->client->whatsappSessions->read("session_id");
    }

    public function testGetQrCode(): void
    {
        $this->mockClient
            ->expects($this->once())->method('performHttpRequest')
            ->with('GET', 'whatsapp/sessions/session_id/qr-code', null, null)
            ->willReturn([200, '{"success": true, "qr_code": "data:image/png;base64,..."}']);

        $result = $this->client->whatsappSessions->getQrCode('session_id');
        self::assertTrue($result->success);
    }

    public function testDisconnect(): void
    {
        $this->mockClient
            ->expects($this->once())->method('performHttpRequest')
            ->with('PATCH', 'whatsapp/sessions/session_id/disconnect', null, null)
            ->willReturn([200, '{"status": "disconnected"}']);

        $this->client->whatsappSessions->disconnect('session_id');
    }

    public function testReconnect(): void
    {
        $this->mockClient
            ->expects($this->once())->method('performHttpRequest')
            ->with('PATCH', 'whatsapp/sessions/session_id/reconnect', null, null)
            ->willReturn([200, '{"status": "connected"}']);

        $this->client->whatsappSessions->reconnect('session_id');
    }

    public function testDeleteSession(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "DELETE",
            'whatsapp/sessions/session_id',
            null,
            null
        );
        $this->client->whatsappSessions->delete('session_id');
    }
}
