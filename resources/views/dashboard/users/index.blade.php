<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Tempo Dashboard: Projects') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @forelse($projects as $project)
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          Name: {{ $project->name }} | Client: {{ $project->client->name }} | Budget: ${{ $project->budget }}
          <a href="{{ route('dashboard.projects.show',$project->id) }}">View Project</a>
        </div>
      </div>
      @empty
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          There are no projects in the database.
        </div>
      </div>
      @endforelse
    </div>
  </div>
</x-app-layout>