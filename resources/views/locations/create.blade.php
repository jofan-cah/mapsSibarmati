@extends('dashboard')

@section('content')
<div class="container mx-auto p-4">
  <h1 class="text-3xl font-bold mb-4">Add Location</h1>

  @if ($errors->any())
  <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('locations.store') }}" method="POST">
    @csrf
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name</label>
      <input type="text" name="name" id="name" class="border p-2 rounded w-full" value="{{ old('name') }}" required>
    </div>
    <div class="mb-4">
      <label for="latitude" class="block text-gray-700">Latitude</label>
      <input type="text" name="latitude" id="latitude" class="border p-2 rounded w-full" value="{{ old('latitude') }}"
        required>
    </div>
    <div class="mb-4">
      <label for="longitude" class="block text-gray-700">Longitude</label>
      <input type="text" name="longitude" id="longitude" class="border p-2 rounded w-full"
        value="{{ old('longitude') }}" required>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
  </form>
</div>
@endsection