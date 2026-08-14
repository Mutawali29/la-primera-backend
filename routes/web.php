<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function (\Illuminate\Http\Request $request) {
    return response()->json([
        'resolved_path' => $request->path(),
        'full_url' => $request->fullUrl(),
        'method' => $request->method(),
    ], 200);
});