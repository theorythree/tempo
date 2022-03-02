<x-site-layout>

  <x-section-wrapper title="Projects" />

  @forelse($clients as $client)
    <x-section-wrapper title="{{ $client->name }}">
      @forelse ($client->projects as $project)
        <x-project-item :project="$project" />
      @empty
        <div class="flex flex-row items-center mb-1 bg-gray-100 p-4 rounded">
          {{ $client->name }} has no projects.
        </div>
      @endforelse
      <div class="mt-5">
        <x-button-link href="{{ route('projects.create') }}">
          + Add a Project
        </x-button-link>
      </div>
    </x-section-wrapper>
  @empty
    <div class="flex flex-row items-center mb-1 bg-gray-100 p-4 rounded">
      No clients found.
    </div>
  @endforelse

</x-site-layout>
