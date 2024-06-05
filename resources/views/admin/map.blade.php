@extends('dashboard')
@section('content')
<div class="flex-1 p-6 md:p-10">
  <header class="flex items-center justify-between pb-6">
    <h2 class="text-3xl font-bold">Maps</h2>
  </header>

  <!-- Content -->
  <div class="grid grid-cols-1 md:grid-cols-1 gap-6 text-center">
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Leaflet Map with Locations</h1>
      <form id="location-form" class="mb-4">
        <input type="text" id="location" name="location" placeholder="Enter location"
          class="border p-2 rounded w-full mb-2">
        <button type="button" onclick="calculateRoute()"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Find Nearest Route</button>
      </form>
      <div id="map" style="height: 500px;"></div>

      <div class="mt-4">
        <h2 class="text-2xl font-bold mb-2">Locations</h2>
        <ul class="list-disc list-inside">
          @foreach ($locations as $location)
          <li>{{ $location->name }}: ({{ $location->latitude }}, {{ $location->longitude }})</li>
          @endforeach
        </ul>
      </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script>
      var map = L.map('map').setView([-7.5666, 110.8167], 13); // Coordinates for Solo, Indonesia

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      @foreach ($locations as $location)
        L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map)
          .bindPopup('{{ $location->name }}');
      @endforeach

      function calculateRoute() {
        var locationInput = document.getElementById('location').value;
        fetch('/api/nearest-route', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ location: locationInput })
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            L.Routing.control({
              waypoints: [
                L.latLng(data.start.lat, data.start.lng),
                L.latLng(data.end.lat, data.end.lng)
              ],
              routeWhileDragging: true
            }).addTo(map);
          } else {
            alert('Route not found!');
          }
        });
      }
    </script>
  </div>
</div>
@endsection