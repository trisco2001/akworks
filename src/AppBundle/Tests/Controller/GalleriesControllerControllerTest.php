<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GalleriesControllerControllerTest extends WebTestCase
{
    public function testListgalleries()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'galleries');
    }

}
