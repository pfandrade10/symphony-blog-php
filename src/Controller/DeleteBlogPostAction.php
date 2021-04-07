<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteBlogPostAction
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route("/posts/{id}", name: "blog_post_delete", methods: ["DELETE"])]
    public function __invoke(int $id): Response
    {
        $repository = $this->entityManager->getRepository(BlogPost::class);
        $blogPost = $repository->find($id);

        $this->entityManager->remove($blogPost);
        $this->entityManager->flush();

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
