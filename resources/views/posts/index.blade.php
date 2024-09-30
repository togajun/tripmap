<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Tripmap</title>
        {{-- Leaflet CSS --}}
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        {{-- Leaflet JavaScript --}}
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> 

        <script src="{{ asset('js/Map/map.js') }}"defer></script>
    </head>
    <body>
        <h1>Tripmap</h1>
        <div id="map" style="height: 750px; width: 90%"></div>
        <a href='/posts/create'>create</a>
    </body>
</html>