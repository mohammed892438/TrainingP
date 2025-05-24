<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

abstract class ResponseJson
{
    public static function sendResponse($result, $message, $code = 200)
    {
        return Response::json(['success' => $code == 200, 'data' => $result, 'message' => $message], $code);
    }

    public static function sendError($error, $code = 400): JsonResponse
    {
        return Response::json(['success' => false, 'data' => null, 'message' => $error], $code);
    }
}