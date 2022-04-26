<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Post;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_returns_json_with_post_info()
    {
        $post = Post::factory()->create();
        $response = $this->get('/api/post/'.$post->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body
        ]);
    }

    public function test_creates_new_post()
    {
        $postTitle = 'This is a new title';
        $postBody = 'Lorem sth sth';

        $response = $this->post('/api/post/add/', ['title' => $postTitle, 'body' => $postBody]);

        $response->assertStatus(201);
        $response->assertJson([
            'title' => $postTitle,
            'body' => $postBody
        ]);
    }

    public function test_delete_new_post()
    {
        $postId = 55;

        $response = $this->post('/api/post/delete/', ['id' => $postId]);

        $response->assertStatus(404);

        $post = Post::factory()->create();

        $response = $this->post('/api/post/delete/', ['id' => $post->id]);

        $response->assertStatus(200);
    }
}
