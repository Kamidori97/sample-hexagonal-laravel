<?php

namespace App\Hexagonal\Post\Domain\Exception;

use Exception;

class RandomException extends Exception
{
    public function render($request)
    {
        return response()->json(['message' => 'Sth not found'], 404);
    }
}