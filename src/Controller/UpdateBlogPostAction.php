<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateBlogPostAction
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    #[Route("/posts/{id}", methods: ["PUT"])]
    public function __invoke(int $id, Request $request): Response
    {
        $requestContent = json_decode($request->getContent(), true);

        $repository = $this->entityManager->getRepository(BlogPost::class);
        $blogPost = $repository->find($id);

        $blogPost->setContent($requestContent['content']);
        $blogPost->setTitle($requestContent['title']);

        $this->entityManager->persist($blogPost);
        $this->entityManager->flush();

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
