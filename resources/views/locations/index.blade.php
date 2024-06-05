@extends('dashboard')

@section('content')
<div class="container mx-auto p-4">
  <h1 class="text-3xl font-bold mb-4">Locations</h1>
  <a href="{{ route('locations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add
    Location</a>

  <table class="min-w-full mt-4 bg-white">
    <thead>
      <tr>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Latitude</th>
        <th class="py-2 px-4 border-b">Longitude</th>
        <th class="py-2 px-4 border-b">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($locations as $location)
      <tr>
        <td class="py-2 px-4 border-b">{{ $location->name }}</td>
        <td class="py-2 px-4 border-b">{{ $location->latitude }}</td>
        <td class="py-2 px-4 border-b">{{ $location->longitude }}</td>
        <td class="py-2 px-4 border-b">
          <a href="{{ route('locations.edit', $location->id) }}" class="text-blue-500 hover:underline">Edit</a>
          <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection