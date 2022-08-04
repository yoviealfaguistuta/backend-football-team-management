<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $SUCCESS_CODE = 200;
    public $VALIDATION_FAILED_CODE = 422;
    public $SERVER_ERROR_CODE = 500;

    public function sendSuccessResponse($data, $type)
    {
        return response()->json([
            'body'      => $data,
            'status'    => true,
            '__type'    => $type
        ], $this->SUCCESS_CODE);
    }

    public function sendFailedResponse($data, $type)
    {
        return response()->json([
            'body'      => $data,
            'status'    => false,
            '__type'    => $type
        ], $this->SERVER_ERROR_CODE);
    }

    public function sendValidationFailedResponse($data, $type)
    {
        return response()->json([
            'body'      => $data,
            'status'    => false,
            '__type'    => $type
        ], $this->VALIDATION_FAILED_CODE);
    }
}
