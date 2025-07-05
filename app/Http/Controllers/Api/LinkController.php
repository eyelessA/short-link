<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Link\StoreRequest;
use App\Services\Link\LinkService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function __construct(private readonly LinkService $linkService)
    {
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $userId = Auth::id();
        $original = $request->validated('original');

        try {
            DB::beginTransaction();

            $result = $this->linkService->store($original, $userId);

            DB::commit();

            return response()->json([
                'message' => $result['message'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Произошла ошибка при сокращении ссылки.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
