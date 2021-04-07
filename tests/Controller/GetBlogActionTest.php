<?php

namespace App\Tests\Controller;

use App\Entity\BlogPost;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GetBlogActionTest extends TestCase
{
    public function test_get_blog_post_should_return_200(): void
    {
        // preparando meu cenário
        $blogPost = new BlogPost();
        $blogPost->setTitle('Blog post de teste');
        $blogPost->setContent('Conteúdo do blog post de teste');
        $this->em->persist($blogPost);
        $this->em->flush();

        // executando o cenário
        $this->client->request(method: 'GET', uri: '/posts/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        // conferindo o cenário
        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

    public function test_get_blog_post_should_return_404(): void
    {
        $this->client->request(method: 'GET', uri: '/posts/1000');
        $statusCode = $this->client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
