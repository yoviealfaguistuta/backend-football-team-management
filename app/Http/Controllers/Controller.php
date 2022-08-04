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

    public function uploadFile($file, $path)
    {
        $nama_file = preg_replace('/\s+/', '', time()."_".$file->getClientOriginalName());
        $tujuan_upload = public_path('/assets/images/'.$path);
        $file->move($tujuan_upload, $nama_file);
        return '/assets/images/'.$path.'/'.$nama_file;
    }

    public function deleteFile($url)
    {
       
        $file_path = public_path() . $url;
        return $file_path;
        return unlink($file_path);
    }
}
