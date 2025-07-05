<?php

namespace App\Services\Link;

use App\Models\Link;
use App\Models\LinkStats;
use App\Models\LinkUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LinkService
{
    protected const CHARSET = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function store(string $url, int $userId): array
    {
        $link = Link::query()->where('original', $url)->first();

        if (!$link) {
            $link = Link::query()->create([
                'original' => $url,
            ]);

            $short = $this->encodeBase62($link->id);

            $link->update([
                'short' => $short,
            ]);
        }

        $linkUser = LinkUser::query()
            ->where('link_id', $link->id)
            ->where('user_id', $userId)
            ->first();

        if (!$linkUser) {
            LinkUser::query()->create([
                'link_id' => $link->id,
                'user_id' => $userId,
            ]);
            return ['message' => 'Ваша ссылка успешно сокращена.'];
        }

        return ['message' => 'Такая ссылка была сокращена ранее.'];
    }

    protected function encodeBase62(int $number): string
    {
        if ($number === 0) {
            return self::CHARSET[0];
        }

        $base = strlen(self::CHARSET);
        $result = '';

        while ($number > 0) {
            $result = self::CHARSET[$number % $base] . $result;
            $number = intdiv($number, $base);
        }

        return $result;
    }

    protected function decodeBase62(string $code): int
    {
        $base = strlen(self::CHARSET);
        $length = strlen($code);
        $number = 0;

        for ($i = 0; $i < $length; $i++) {
            $pos = strpos(self::CHARSET, $code[$i]);
            $number = $number * $base + $pos;
        }

        return $number;
    }

    public function redirectToOriginal(string $url, int $userId): RedirectResponse|JsonResponse
    {
        $short = Link::query()->where('short', $url)->firstOrFail();
        $exist = LinkUser::query()
            ->where('link_id', $short->id)
            ->where('user_id', $userId)
            ->first();

        if (!$exist) {
            return response()->json(['message' => 'У вас нет доступа к этой ссылке'], 403);
        }
        $this->logStats($short->id);
        return redirect($short->original);
    }

    public function logStats(int $LinkId): void
    {
        LinkStats::query()->create([
            'link_id' => $LinkId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
