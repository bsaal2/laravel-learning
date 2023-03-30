<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\TestServiceInterface;
use Throwable;

class AuthController extends Controller
{
    public function login(StorePostRequest $request) {
        try {
            $payload = $request->validated();

            if(!Auth::attempt([
                'email' => $payload['email'],
                'password' => $payload['password']
            ])) {
                return Response::json([
                    'success' => false,
                    'message' => 'Invalid Credentials!'
                ], 401);
            }
            else {
                $user = $request->user();
                $token = $user->createToken('MyApp')->plainTextToken;
                $response = ['success' => true, 'data' => ['token' => $token, 'name' => $user->name]];
                return Response::json($response, 200);
            }
        }
        catch (Throwable $e) {
            return Response::json([
                'success' => false,
                'error' => $e,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    public function register(UserRegisterRequest $request) {
        try {
            $payload = $request->validated();
            $payload['password'] = bcrypt($payload['password']);
            $user = User::create($payload);
            $token = $user->createToken('MyApp')->plainTextToken;
            $response = ['success' => true, 'data' => ['token' => $token, 'user' => $user]];
            return Response::json($response, 200);
        }
        catch (Throwable $e) {
            return Response::json([
                'success' => false,
                'error' => $e,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    public function changePassword(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'newPassword' => 'required|string|min:5|max:20|confirmed'
            ]);

            if ($validator->fails()) {
                return Response::json([
                    'success' => false,
                    'error' => $validator->errors(),
                ], 400);
            }

            $password = $validator->validated()['newPassword'];
            $passwordHash = bcrypt($password);

            $user = Auth::user();
            if ($passwordHash === $user->password) {
                return Response::json([
                    'success' => false,
                    'message' => 'User cannot have the same as last password'
                ], 400);
            }

            $userModel = User::find($user->id);
            $userModel->password = $passwordHash;
            $userModel->save();

            return Response::json([
                'success' => true,
                'message' => 'success on password change!'
            ]);
        }
        catch (Throwable $e) {
            return Response::json([
                'success' => false,
                'error' => $e,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    public function controllerTest(Request $request, TestServiceInterface $testService) {
        echo $testService->sayHello();
    }
}
