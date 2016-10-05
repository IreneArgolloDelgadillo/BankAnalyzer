<?php

namespace AnalyzerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnalyzerHomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Index');
    }

    public function testHelp()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Help');
    }

    public function testSaveofficialdata()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/SaveOfficialData');
    }

}
