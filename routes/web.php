<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\SpotifyController;

Route::get('/spotify/albums', [SpotifyController::class, 'getAlbums']);
Route::get('/spotify/playlists', [SpotifyController::class, 'getPlaylists']);
