<?php

namespace Tests\Integration;

use InvalidArgumentException;
use Ourvoice\Client;
use Ourvoice\Common\HttpClient;
use Ourvoice\Exceptions\AuthenticateException;
use stdClass;

class HttpClientTest extends BaseTest
{
    public function testHttpClient(): void
    {
        $client = new HttpClient(Client::ENDPOINT);

        $url = $client->getRequestUrl('a', null);
        self::assertSame(Client::ENDPOINT . '/a', $url);

        $url = $client->getRequestUrl('a', ['b' => 1]);
        self::assertSame(Client::ENDPOINT . '/a?b=1', $url);
    }

    public function testHttpClientInvalidTimeout(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Timeout must be an int > 0, got "integer 0"');
        new HttpClient(Client::ENDPOINT, 0);
    }

    
    public function testHttpClientValidTimeoutBoundary(): void
    {
        new HttpClient(Client::ENDPOINT, 1);

        $this->doAssertionToNotBeConsideredRiskyTest();
    }


    public function testHttpClientValidConnectionTimeoutBoundary(): void
    {
        new HttpClient(Client::ENDPOINT, 10, 0);

        $this->doAssertionToNotBeConsideredRiskyTest();
    }

  
    public function testHttpClientWithoutAuthenticationException(): void
    {
        $this->expectException(AuthenticateException::class);
        $this->expectExceptionMessage('Can not perform API Request without Authentication');
        $client = new HttpClient(Client::ENDPOINT);
        $client->performHttpRequest('foo', 'bar');
    }

   
    public function testHttpClientWithHttpOptions(): void
    {
        $client = new HttpClient(Client::ENDPOINT);
        $url = '127.0.0.1:8080';

        $client->addHttpOption(\CURLOPT_PROXY, $url);

        self::assertSame($client->getHttpOption(\CURLOPT_PROXY), $url);
    }
}
