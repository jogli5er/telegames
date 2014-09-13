<?php

namespace Hackathon\Bundle\GameBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatisticsControllerTest extends WebTestCase
{
    public function testSelectedoptions()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'statistics/selectedOptions');
    }

}
