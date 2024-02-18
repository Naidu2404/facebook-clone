<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidationErrorException extends Exception
{
    //
    public function render(Request $request)
    {
        return response()->json([
            'errors' => [
                'code' => 422,
                'title' => 'Validation Error',
                'detail' => 'You request is malformed or missing fields.',
                'meta' => json_decode($this->getMessage()),
            ],
        ], 422);
    }
}