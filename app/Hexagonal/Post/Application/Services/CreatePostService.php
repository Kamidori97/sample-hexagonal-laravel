<?php

namespace App\Hexagonal\Post\Application\Services;

use App\Hexagonal\Post\Domain\Repositories\PostRepositoryInterface;

class CreatePostService
{
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $title, string $body)
    {
        $post = $this->repository->create([
            'title'     => $title,
            'body'      => $body
        ]);

        return $post;
    }
}