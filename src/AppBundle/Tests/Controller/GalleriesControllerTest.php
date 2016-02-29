<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GalleriesControllerTest extends WebTestCase
{
    public function testGalleries()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/galleries');
    }

}
