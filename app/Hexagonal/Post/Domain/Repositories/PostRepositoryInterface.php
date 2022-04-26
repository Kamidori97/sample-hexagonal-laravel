<?php

namespace App\Hexagonal\Post\Domain\Repositories;

interface PostRepositoryInterface
{
    public function find(int $postId);

    public function create(array $data);

    public function delete(int $postId);
}