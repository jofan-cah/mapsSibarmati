@extends('dashboard')
@section('content')
<div class="flex-1 p-6 md:p-10">
  <header class="flex items-center justify-between pb-6">
    <h2 class="text-3xl font-bold">Dashboard</h2>
  </header>

  <!-- Content -->
  <div class="grid grid-cols-1 md:grid-cols-1  gap-6 text-center">
    <div class="card bg-white shadow-xl rounded-2xl p-4">
      <h2 class="text-2xl font-bold">Welcome {{ Auth::user()->name }}, Happy Sunday!</h2>
      <p class="text-md mt-2 text-slate-700">

        <options=bold>“ When there is no desire, all things are at peace. ”
          <fg=gray>— Laozi

          </fg=gray>
        </options=bold>
      </p>
    </div>

  </div>
</div>
@endsection