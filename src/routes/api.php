<?php

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    try {
        DB::connection('mongodb')->command(['ping' => 1]);

        return response()->json([
            'status' => 'ok',
            'app' => config('app.name'),
            'timestamp' => now()->toISOString(),
        ], 200);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'MongoDB connection failed',
        ], 500);
    }
});
