<x-site-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $project->name }}
      @if (Auth::user()->can('update', $project))
        <x-button-link href="{{ route('projects.edit', $project->id) }}">
          Edit
        </x-button-link>
      @endif
    </h2>
  </x-slot>

  <x-section-wrapper title="Project Details:">

    <div class="flex gap-4 columns-2">
      <h3 class="w-20 font-bold">Client:</h3>
      <div>{{ $project->client->name }}</div>
    </div>
    <div class="flex gap-4 columns-2">
      <h3 class="w-20 font-bold">Budget:</h3>
      <div>${{ number_format($project->budget, 2, '.', ',') }}</div>
    </div>
  </x-section-wrapper>

  <x-section-wrapper title="Project Description:">
    {{ $project->description }}
  </x-section-wrapper>

  <x-section-wrapper title="Time Entries:">
    @forelse($project->timeEntries as $timeEntry)
      <x-time-entry-item :timeEntry="$timeEntry" />
    @empty
      <div class="flex flex-row items-center mb-1 bg-gray-100 p-4 rounded">
        {{ $project->name }} does not have any time entries.
      </div>
    @endforelse
    <h2>Total Time: {{ $project->totalTime }}</h2>
    <h2>Total Cost: ${{ $project->totalCostDisplay }}</h2>
  </x-section-wrapper>

</x-site-layout>
