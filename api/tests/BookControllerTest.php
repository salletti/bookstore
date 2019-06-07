<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testBook(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/book/1');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('#app'));
        $this->assertCount(1, $crawler->filter('#cover-book'));
    }
}
