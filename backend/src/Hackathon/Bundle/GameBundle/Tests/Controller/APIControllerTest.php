<?php

namespace Hackathon\Bundle\GameBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APIControllerTest extends WebTestCase
{
    public function testJoin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'game/join');
    }

    public function testMove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'game/move');
    }

}
