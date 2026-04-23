<?php

namespace App\Support;

use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Support\Facades\DB;

class PointService
{
    public static function award(User $user, int $amount, string $type, ?string $description = null, $related = null, array $meta = []): UserPoint
    {
        return DB::transaction(function () use ($user, $amount, $type, $description, $related, $meta) {
            $point = new UserPoint([
                'type' => $type,
                'amount' => $amount,
                'description' => $description,
                'meta' => $meta,
            ]);
            if ($related) {
                $point->related()->associate($related);
            }
            $point->user()->associate($user);
            $point->save();
            $user->increment('coins_balance', $amount);
            try { \Log::info('Coins awarded', ['user_id'=>$user->id,'amount'=>$amount,'type'=>$type,'point_id'=>$point->id]); } catch (\Throwable $e) {}
            return $point;
        });
    }

    public static function adjust(User $user, int $amount, string $reason = 'admin_adjust'): UserPoint
    {
        return self::award($user, $amount, 'admin_adjust', $reason);
    }
}


