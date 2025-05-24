<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

abstract class APIController
{
    public function sendResponse($result, $message, $code =200)
    {
        return Response::json(['success'=> $code==200, 'data'=> $result, 'message'=> $message], $code);
    }

    public function sendError($error, $code =400): JsonResponse
    {
        return Response::json(['success'=> $code==200, 'data'=> null, 'message'=> $error], $code);
    }

}