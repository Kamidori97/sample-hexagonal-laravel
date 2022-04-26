<?php

namespace Tests\Unit\Post;

use App\Hexagonal\Post\Domain\Repositories\PostRepositoryInterface;
use App\Hexagonal\Post\Application\Services\DeletePostService;
use App\Hexagonal\Post\Domain\Exception\PostNotFoundException;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;
use App\Models\Post;

class DeletePostServiceTest extends TestCase
{
    private $service;
    private $repoMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repoMock = Mockery::mock(PostRepositoryInterface::class);
        $this->service = new DeletePostService($this->repoMock);
    }

    public function test_repo_delete_is_called()
    {
        $id = 1;
        $post = Post::factory()->make();
        $this->repoMock->shouldReceive('find')->with($id)->andReturn($post)->once();
        $this->repoMock->shouldReceive('delete')->with($id)->once();

        $this->service->__invoke($id);
    }

    public function test_throws_exception_when_not_found()
    {
        $id = 1;
        $this->repoMock->shouldReceive('find')->with($id)->andReturn(null)->once();

        $this->expectException(PostNotFoundException::class);

        $this->service->__invoke($id);
    }
}
