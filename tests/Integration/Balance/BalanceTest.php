<?php

namespace Tests\Integration\Balance;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;

class BalanceTest extends BaseTest
{
    public function testListBalance(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'balances', null, null);
        $this->client->balances->read();
    }

    public function testViewBalance(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'balances/balance_id',
            null,
            null
        );
        $this->client->balances->read("balance_id");
    }
    public function testDeleteBalance(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'balances/balance_id',
            null,
            null
        );
        $this->client->balances->delete("balance_id");
    }
}
