<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Tempo Dashboard: Clients') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @forelse($clients as $client)
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          Name: {{ $client->name }} | Code: {{ $client->code }}
          <a href="{{ route('dashboard.clients.show', $client->id) }}">View</a>
        </div>
      </div>
      @empty
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          There are no clients in the database.
        </div>
      </div>
      @endforelse
    </div>
  </div>
</x-app-layout>