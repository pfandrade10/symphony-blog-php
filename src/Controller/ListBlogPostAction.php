<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListBlogPostAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer
    )
    {
    }

    #[Route("/posts", methods: ["GET"])]
    public function __invoke(): Response
    {
        $repository = $this->entityManager->getRepository(BlogPost::class);
        $blogPosts = $repository->findAll();
        $response = $this->serializer->serialize($blogPosts, 'json');
        return JsonResponse::fromJsonString($response);
    }
}
