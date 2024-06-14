<?php
// app/Helpers/ApiResponse.php

namespace App\Helpers;

class ApiResponse
{
    public static function sendResponse($statusCode, $message, $data = null)
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
