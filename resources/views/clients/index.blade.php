<x-site-layout>
  <x-section-wrapper title="Clients">
    @forelse ($clients as $client)
      <div class="flex flex-row items-center mb-1 bg-gray-100 p-2 rounded">
        <div class="basis-3/4">
          <h3 class="pl-2">{{ $client->name }}</h3>
        </div>
        <div class="basis-1/4">
          <div class="flex flex-row-reverse">
            <x-button-link href="{{ route('clients.show', $client->id) }}">
              View
            </x-button-link>
            @if (Auth::user()->can('update', $client))
              <x-button-link href="{{ route('clients.edit', $client->id) }}">
                Edit
              </x-button-link>
            @endif
          </div>
        </div>
      </div>
    @empty
      <div class="flex flex-row items-center mb-1 bg-gray-100 p-4 rounded">
        Sorry you have no clients yet.
      </div>
    @endforelse
    <div class="mt-5">
      <x-button-link href="{{ route('clients.create') }}">
        + Add a Client
      </x-button-link>
    </div>
  </x-section-wrapper>
</x-site-layout>
