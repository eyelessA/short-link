<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $result = $this->authService->register($data);

        return response()->json($result);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $result = $this->authService->login($data);

        if (!$result) {
            return response()->json(['message' => 'Неверные учетные данные'], 401);
        }

        return response()->json($result);
    }
}
