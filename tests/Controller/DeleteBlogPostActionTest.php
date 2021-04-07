<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\BlogPost;
use App\Tests\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

final class DeleteBlogPostActionTest extends TestCase
{
    public function test_delete_blog_post_should_return_no_content(): void
    {
        // preparando meu cenário
        $blogPost = new BlogPost();
        $blogPost->setTitle('Blog post de teste');
        $blogPost->setContent('Conteúdo do blog post de teste');
        $this->em->persist($blogPost);
        $this->em->flush();

        // executando o cenário
        $this->client->request(method: 'DELETE', uri: '/posts/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        // conferindo o cenário
        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }
}
