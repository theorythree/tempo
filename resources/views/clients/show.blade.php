<x-site-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $client->name }}
    </h2>
  </x-slot>

  <x-section-wrapper>
    @if (Auth::user()->can('update', $client))
      <x-button-link href="{{ route('clients.edit', $client->id) }}">
        Edit Client Details
      </x-button-link>
    @endif
  </x-section-wrapper>

  <x-section-wrapper title="Client Details:">

    <div class="flex gap-4 columns-2">
      <h3 class="w-20 font-bold">Name:</h3>
      <div>{{ $client->name }}</div>
    </div>
    <div class="flex gap-4 columns-2">
      <h3 class="w-20 font-bold">Code:</h3>
      <div>{{ $client->code }}</div>
    </div>
    @if ($client->phone)
      <div class="flex gap-4 columns-2">
        <h3 class="w-20 font-bold">Phone:</h3>
        <div>{{ $client->phoneDisplay }}</div>
      </div>
    @endif
    @if ($client->address)
      <div class="flex gap-4 columns-2">
        <h3 class="w-20 font-bold">Address:</h3>
        <div>{!! nl2br($client->address) !!}</div>
      </div>
    @endif
  </x-section-wrapper>

  <x-section-wrapper title="Projects:">
    @forelse ($client->projects as $project)
      <x-project-item :project="$project" />
    @empty
      <div class="flex flex-row items-center mb-1 bg-gray-100 p-4 rounded">
        {{ $client->name }} does not have any projects.
      </div>
    @endforelse

  </x-section-wrapper>

  <x-section-wrapper>
    <x-button-link href="{{ route('projects.create') }}/?client={{ $client->id }}">
      + Add a Project
    </x-button-link>
  </x-section-wrapper>

</x-site-layout>
