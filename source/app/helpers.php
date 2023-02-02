<?php

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use Nos\EmojiReaction\Interfaces\Models\EmojiReactionInterface;
use Nos\EmojiReaction\Services\ReactionStatisticService;

if (!function_exists('getEmojiReactionStatistics')) {
    /**
     * @throws BindingResolutionException
     */
    function getEmojiReactionStatistics(EmojiReactionInterface $model): Collection
    {
        $service = app()->make(ReactionStatisticService::class);

        return $service->getByModel($model);
    }
}
