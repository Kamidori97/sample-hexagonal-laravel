<?php

namespace App\Hexagonal\Post\Infrastructure;

use App\Hexagonal\Post\Domain\Repositories\PostRepositoryInterface;
use App\src\Currency\Domain\CurrencyNotFoundException;
use App\Models\Post;

class PostRepositoryEloquent implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function delete(int $postId)
    {
        return $this->model->destroy($postId);
    }

    public function find(int $postId)
    {
        return $this->model->find($postId);
    }
}