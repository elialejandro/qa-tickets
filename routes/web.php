<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/hello', function () {
    return response()->json([
        'message' => 'Hello, World!',
    ]);
});
