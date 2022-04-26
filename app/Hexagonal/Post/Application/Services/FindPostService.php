<?php

namespace App\Hexagonal\Post\Application\Services;

use App\Hexagonal\Post\Domain\Repositories\PostRepositoryInterface;
use App\Hexagonal\Post\Domain\Exception\PostNotFoundException;

class FindPostService
{
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $postId)
    {
        $post = $this->repository->find($postId);
        if (empty($post)) {
            throw new PostNotFoundException();
        }

        return $post;
    }
}