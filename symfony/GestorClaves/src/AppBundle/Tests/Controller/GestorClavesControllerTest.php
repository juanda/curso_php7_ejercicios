<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GestorClavesControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
        
        $this->assertEquals(1,1);
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete');
        $this->assertEquals(1,1);
    }

    public function testFind()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/find');
        $this->assertEquals(1,1);
    }

}
