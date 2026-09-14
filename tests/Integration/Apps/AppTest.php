<?php

namespace Tests\Integration\Apps;

use Ourvoice\Exceptions\ServerException;
use Ourvoice\Objects\App;
use Tests\Integration\BaseTest;

class AppTest extends BaseTest
{
    public function testCreateApp(): void
    {
        $app = new App();
        $app->name = "My App";
        $app->sender_id = "sender_id";

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '{
            "name": "My App",
            "sender_id": "sender_id",
            "created_at": "2016-04-29T09:42:26+00:00",
            "updated_at": "2016-04-29T09:42:26+00:00"
        }',
        ]);

        $this->client->apps->create($app);
    }

    public function testListApps(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'apps',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->apps->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewApp(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "GET",
            'apps/app_id',
            null,
            null
        );
        $this->client->apps->read("app_id");
    }

    public function testUpdateApp(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'apps/app_id', null, '{"name":"Updated App"}'],
            )
            ->willReturn([200, '{}']);

        $app = new App();
        $app->name = "Updated App";
        $this->client->apps->update($app, 'app_id');
    }

    public function testDeleteApp(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with(
            "DELETE",
            'apps/app_id',
            null,
            null
        );
        $this->client->apps->delete("app_id");
    }
}
