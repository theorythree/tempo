<x-site-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $client->name }}
    </h2>
  </x-slot>

  <x-section-wrapper title="Client Details:">
    <div class="flex gap-4 columns-2">
      <h3 class="w-20 font-bold">Code:</h3>
      <div>{{ $client->code }}</div>
    </div>
    <div class="flex gap-4 columns-2">
      <h3 class="w-20 font-bold">Address:</h3>
      <div>{{ $client->address }} {{ $client->phone }}</div>
    </div>
  </x-section-wrapper>

</x-site-layout>
