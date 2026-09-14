<?php

namespace Tests\Integration\Whatsapp;

use Ourvoice\Exceptions\ServerException;
use Tests\Integration\BaseTest;

class WhatsappMessageTest extends BaseTest
{
    public function testSendMessage(): void
    {
        $params = [
            'whatsapp_session_id' => 'session_id',
            'to_number' => ['22912121212'],
            'type' => 'text',
            'content' => 'Hello',
        ];

        $this->mockClient
            ->expects($this->once())->method('performHttpRequest')
            ->with('POST', 'whatsapp/messages', null, json_encode($params, \JSON_THROW_ON_ERROR))
            ->willReturn([200, '{
                "success": true,
                "message": "Messages queued",
                "data": {"messages": [], "count": 1, "total_cost": 10, "new_balance": 990, "remaining_messages": 0}
            }']);

        $result = $this->client->whatsappMessages->send($params);
        self::assertTrue($result->success);
        self::assertSame(1, $result->data->count);
    }

    public function testListMessages(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'whatsapp/messages',
            [],
            null
        );
        $this->client->whatsappMessages->getList();
    }

    public function testGetSessionMessages(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'whatsapp/messages/session_id/session',
            [],
            null
        );
        $this->client->whatsappMessages->getSessionMessages('session_id');
    }

    public function testViewMessage(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'whatsapp/messages/message_id',
            null,
            null
        );
        $this->client->whatsappMessages->read('message_id');
    }
}
