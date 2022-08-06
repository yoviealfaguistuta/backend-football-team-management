<?php

namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'string'],
                'password' => ['required', 'string', 'min:6'],
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'body' => [
                        'messages' => $validator->messages()
                    ],
                    'status' => false,
                    '__type' => 'login'
                ], $this->VALIDATION_FAILED_CODE);
            }
            
            $admin = Admin::where('email', $request->email)->first();
            
            if ($admin === null || $request->email !== $admin->email) {
                return response()->json([
                    'body' => [
                        'messages' => 'Pengguna tidak ditemukan'
                    ],
                    'status' => false,
                    '__type' => 'login'
                ], $this->VALIDATION_FAILED_CODE);
            }

            if (!Hash::check($request->password, $admin->password)) {
                return response()->json([
                    'body' => [
                        'messages' => 'Kata sandi tidak cocok'
                    ],
                    'status' => false,
                    '__type' => 'login'
                ], $this->VALIDATION_FAILED_CODE);
            }
            
            $tokenResult = $admin->createToken('authToken')->plainTextToken;

            return response()->json([
                'body' => [
                    'token' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
                'status' => true,
                '__type' => 'login'
            ], $this->SUCCESS_CODE);

        } catch (Exception $e) {

            return response()->json([
                'body' => [
                    'messages' => $e->getMessage(),
                ],
                'status' => false,
                '__type' => 'login'
            ], $this->SERVER_ERROR_CODE);

        }
    }
}
