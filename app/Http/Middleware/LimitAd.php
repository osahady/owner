<?php

namespace App\Http\Middleware;

use App\Models\Ad;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class LimitAd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $businessState = $user->business_state;
        $days = 30;
        $back = Carbon::now()->subDays($days);
        $ads = $user->ads()
            // Ad::where('user_id', $user->id)
            ->where('created_at', '>=', $back)
            ->count();
        switch ($businessState) {
            case 'plus':
                $allowedAds = 2 * $days;
                break;
            case 'premium':
                $allowedAds = 3 * $days;
                break;

            default:
                $allowedAds = 1 * $days;
                break;
        }
        if ($ads < $allowedAds) {

            return $next($request);
        } else {
            return response()->json([
                'message' => 'You reached the allowed ads',
                '# of your ads' => $ads,
                'plan' => $businessState,
                'allowed ads' => $allowedAds,
            ], 422);
        }
    }
}
