<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetBlogPostAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    )
    {
    }

    #[Route("/posts/{id}", name: "blog_post_get", methods: ["GET"])]
    public function __invoke(int $id): Response
    {
        $repository = $this->entityManager->getRepository(BlogPost::class);
        $blogPost = $repository->find($id);

        if (null === $blogPost) {
            return new JsonResponse([
                'error' => 'BlogPost not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return JsonResponse::fromJsonString($this->serializer->serialize($blogPost, 'json'));
    }
}
