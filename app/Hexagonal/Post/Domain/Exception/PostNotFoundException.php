<?php

namespace App\Hexagonal\Post\Domain\Exception;

use Exception;

class PostNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json(['message' => 'Post not found'], 404);
    }
}