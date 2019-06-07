<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class BookControllerPantherTest extends PantherTestCase
{
    /**
     * Test with internal php server and panther client
     */
    public function testBookWithPanther(): void
    {
        $client = static::createPantherClient();

        $crawler = $client->request('GET', '/book/1');

        $this->assertContains('Welcome to Your Bookstore', $crawler->filter('h1')->text());
    }
}
