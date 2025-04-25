<!DOCTYPE html>
<html>
<head>
    <title>{{ $type }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container py-5">
        <h1>{{ $type }} 🎶</h1>
        <a href="/spotify/albums" class="btn btn-outline-light btn-sm mt-3">Album Populer</a>
        <a href="/spotify/playlists" class="btn btn-outline-light btn-sm mt-3">Playlist Populer</a>
        <hr class="text-secondary">

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 mt-4">
            @forelse ($items as $item)
                @php
                    $node = $item['data'] ?? $item; 
                    $name = $node['name'] ?? 'METAL GEAR RISING REVENGEANCE Vocal Tracks Selection';
                    $link = $node['uri'] ?? 'spotify:album:3DR0FThvw6I18Ntp3D6kxf';
                    $img = $node['images'][0]['url'] ?? 
                           $node['coverArt']['sources'][0]['url'] ?? 
                           '';
                    $desc = $node['description'] ?? ($node['type']['__typename'] ?? '');
                    $link = str_replace('spotify:', 'https://open.spotify.com/', $link);
                @endphp

                <div class="col">
                    <div class="card h-100 bg-secondary text-white">
                        @if($img)
                            <img src="{{ $img }}" class="card-img-top" alt="Cover">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $name }}</h5>
                            <p class="card-text">{{ $desc }}</p>
                            <a href="{{ $link }}" class="btn btn-light btn-sm" target="_blank">🎧 Lihat di Spotify</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada data tersedia.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
