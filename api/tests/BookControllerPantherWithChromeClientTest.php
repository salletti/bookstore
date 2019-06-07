<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Panther\Client;

class BookControllerPantherWithChromeClientTest extends TestCase
{
    /**
     * Test directly with chrome driver without booting php server and calling the api docker container directly
     */
    public function testBookWithChromeClientPanther(): void
    {
        $client = Client::createChromeClient(null, null, [], 'http://api');
        $crawler = $client->request('GET', '/book/1');

        $this->assertContains('Welcome to Your Bookstore', $crawler->filter('h1')->text());
    }
}
