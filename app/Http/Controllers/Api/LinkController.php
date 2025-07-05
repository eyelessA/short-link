<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Link\StoreRequest;
use App\Http\Resources\Link\LinkResource;
use App\Services\Link\LinkService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function __construct(private readonly LinkService $linkService) {}

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

    public function index(): AnonymousResourceCollection
    {
        $user = Auth::user();
        $links = $this->linkService->index($user);
        return LinkResource::collection($links);
    }

    public function destroy(int $id): JsonResponse
    {
        $userId = Auth::id();
        $this->linkService->destroy($userId, $id);
        return response()->json(null, 204);
    }

    public function show(int $id): JsonResponse|LinkResource
    {
        try {
            $userId = Auth::id();
            $link = $this->linkService->show($userId, $id);

            return LinkResource::make($link);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'У вас нет доступа к этой ссылке',
                'error' => $e->getMessage(),
            ], 403);
        }
    }

    public function redirectToOriginal(string $short): JsonResponse|RedirectResponse
    {
        $userId = Auth::id();
        try {
            return $this->linkService->redirectToOriginal($short, $userId);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'У вас нет сохраненных ссылок',
                'error' => $e->getMessage(),
            ], 404);
        }
    }
}
