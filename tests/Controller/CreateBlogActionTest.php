<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateBlogActionTest extends WebTestCase
{
    public function test_create_blog_post(): void
    {
        $client = static::createClient();
        $client->request(method: 'POST', uri: '/posts',
            content: json_encode([
                'title' => 'Primeiro teste funcional',
                'content' => 'Conteúdo do primeiro teste funcional'
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_CREATED, $statusCode);
    }

    public function test_create_blog_post_with_invalid_data(): void
    {
        $client = static::createClient();
        $client->request(method: 'POST', uri: '/posts',
            content: json_encode([
                'content' => 'Conteúdo do primeiro teste funcional'
            ])
        );

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_BAD_REQUEST, $statusCode);
    }
}
