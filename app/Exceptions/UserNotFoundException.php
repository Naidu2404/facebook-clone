<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserNotFoundException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->json([
            'errors' => [
                'code' => 404,
                'title' => 'user not found',
                'detail' => 'unable to locate user with the given information',
            ],
        ], 404);
    }
}