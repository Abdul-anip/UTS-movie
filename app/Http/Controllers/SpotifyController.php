<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpotifyController extends Controller
{
    private $headers;

    public function __construct()
    {
        $this->headers = [
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            'X-RapidAPI-Host' => 'spotify23.p.rapidapi.com'
        ];
    }

    public function getAlbums()
    {
        $response = Http::withHeaders($this->headers)->get('https://spotify23.p.rapidapi.com/artist_albums/', [
            'id' => '06HL4z0CvFAxyc27GXpf02', // ID Taylor Swift
            'offset' => '0',
            'limit' => '10'
        ]);
    
        $data = $response->json();
    
        $items = $data['data']['artist']['discography']['albums']['items'] ?? [];
    
        $albums = array_map(fn($item) => $item['releases']['items'][0] ?? [], $items);
    
        return view('spotify', [
            'type' => 'Album Populer',
            'items' => $albums
        ]);
    }

    public function getPlaylists()
    {
        $response = Http::withHeaders($this->headers)->get('https://spotify23.p.rapidapi.com/search/', [
            'q' => 'metal',              
            'type' => 'multi',    
            'offset' => '0',         
            'limit' => '10',          
        ]);
    
        $data = $response->json();
    
        $items = $data['playlists']['items'] ?? [];
    
        return view('spotify', [
            'type' => 'Playlist Populer',
            'items' => $items
        ]);
    }
    
}
