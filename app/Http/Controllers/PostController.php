<?php

namespace App\Http\Controllers;

use App\Hexagonal\Post\Application\Services\CreatePostService;
use App\Hexagonal\Post\Application\Services\DeletePostService;
use App\Hexagonal\Post\Domain\Exeption\PostNotFoundException;
use App\Hexagonal\Post\Application\Services\FindPostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postCreator;
    private $postFinder;
    private $postDeleter;

    public function __construct(
        CreatePostService $postCreator,
        FindPostService $postFinder,
        DeletePostService $postDeleter
    ) {
        $this->postCreator = $postCreator;
        $this->postFinder = $postFinder;
        $this->postDeleter = $postDeleter;
    }

    public function postPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        return $this->postCreator->__invoke(
            $request->post('title'),
            $request->post('body')
        );
    }

    public function getPost(int $postId)
    {
        return $this->postFinder->__invoke($postId);
    }

    public function deletePost(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $this->postDeleter->__invoke($request->post('id'));
        } catch (PostNotFoundException $e) {
            return response('Resource not found', 404);
        }

        return response('Success deleting the post', 200);
    }
}
