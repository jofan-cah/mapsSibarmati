<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    #map {
      height: 500px;
    }
  </style>

  {{--
  <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <div class="flex flex-col md:flex-row">
    <!-- Sidebar -->
    <aside class="bg-gray-800 w-auto md:w-64 h-screen ">
      <div class="flex items-center justify-center h-20 bg-gray-900">
        <h1 class="text-white text-2xl">Admin</h1>
      </div>
      <nav class="text-white text-base font-semibold pt-3">
        <a href="{{route('home')}}" class="flex items-center py-4 pl-6 bg-gray-700">
          <span class="mr-3">🏠</span> Dashboard
        </a>
        <a href="{{route('map')}}" class="flex items-center py-4 pl-6 hover:bg-gray-700">
          <span class="mr-3">📄</span> Maps
        </a>
        <a href="{{route('mapCreate')}}" class="flex items-center py-4 pl-6 hover:bg-gray-700">
          <span class="mr-3">📊</span> Maps UDB
        </a>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="flex items-center py-4 pl-6 hover:bg-gray-700">
          <span class="mr-3">🚪</span> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </nav>
    </aside>

    <!-- Main Content -->
    @yield('content')

  </div>

</body>

</html>