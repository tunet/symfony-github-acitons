<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
	public function testCreate(): void
    {
        $client = static::createClient();

        $client->request('GET', '/tasks/add');

        self::assertResponseIsSuccessful();

        $client->submitForm('Add', [
            'title'       => 'Aaa',
            'description' => 'Bbb',
        ]);

        self::assertResponseRedirects('/tasks/');
        $client->followRedirect();

        self::assertSelectorTextContains('strong', 'Aaa');
        self::assertSelectorTextContains('li', 'Bbb');
    }
}
