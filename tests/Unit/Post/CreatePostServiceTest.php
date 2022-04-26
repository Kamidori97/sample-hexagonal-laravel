<?php

namespace Tests\Unit\Post;

use App\Hexagonal\Post\Domain\Repositories\PostRepositoryInterface;
use App\Hexagonal\Post\Application\Services\CreatePostService;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CreatePostServiceTest extends TestCase
{
    private $service;
    private $repoMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repoMock = Mockery::mock(PostRepositoryInterface::class);
        $this->service = new CreatePostService($this->repoMock);
    }

    public function test_repo_create_is_called()
    {
        $title = 'This is a title?';
        $body = 'loremasdfkashdfkjasdf';
        $postId = 1;
        $existingPost = null;
        $this->repoMock->shouldReceive('create')->with(['title' => $title, 'body' => $body])->once();

        $this->service->__invoke($title, $body);
    }
}
