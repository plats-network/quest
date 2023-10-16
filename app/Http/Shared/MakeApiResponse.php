<?php

namespace App\Http\Shared;

use Illuminate\Http\JsonResponse;

trait MakeApiResponse
{
    public function successResponse(string|array $message, $data=[]): JsonResponse
    {
        $data = [
            'status' => 'success',
            'data' => $data,
        ];

        if (is_string($message)) {
            return response()->json(
                array_merge($data, ['message' => $message])
            );
        }

        return response()->json(
            array_merge($data, $message)
        );
    }

    public function errorResponse(string|array $message, int $code): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }
}
