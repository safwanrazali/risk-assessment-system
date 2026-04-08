<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Carbon;

class GreetingService
{
    public function greeting(User $user): string
    {
        $timezone = config('app.timezone');
        $hour = Carbon::now($timezone)->hour;

        if ($hour < 12) {
            $time = 'Pagi';
            $icon = '🌅';
        } elseif ($hour < 14) {
            $time = 'Tengah Hari';
            $icon = '☀️';
        } elseif ($hour < 19) {
            $time = 'Petang';
            $icon = '🌤️';
        } else {
            $time = 'Malam';
            $icon = '🌙';
        }

        return " Selamat {$time} {$icon}, {$user->name}";
    }
}
