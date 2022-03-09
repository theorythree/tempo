<x-site-layout>
  <x-form-wrapper title="Edit Project">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('projects.update', $project->id) }}">
      @csrf
      @method('put')

      <input type="hidden" name="client_id" value="{{ $client->id }}">

      <div class="flex flex-row">
        <div class="basis-1/2 mr-4">
          <x-label for="name" :value="__('Name')" />
          <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
            value="{{ old('name') ?? $client->name }}" required />
        </div>
        <div class="basis-1/2 ml-4">
          <x-label for="budget" :value="__('Budget (USD)')" />
          <x-input id="budget" class="block mt-1 w-sm" type="text" name="budget" :value="old('budget')"
            value="{{ old('budget') ?? $client->budget }}" />
        </div>
      </div>

      <div class="flex flex-row mt-4">
        <div class="basis-1/2 mr-4">
          <x-label for="description" :value="__('Description')" />
          <x-input-textarea id="address" class="block mt-1 w-full" type="text" name="description">
            {{ old('description') ?? $client->description }}</x-input-textarea>
        </div>
      </div>

      <div class="flex items-center justify-start mt-4">
        <x-button-link href="{{ route('clients.show', $client->id) }}">
          {{ __('Cancel') }}
        </x-button-link>
        <x-button>
          {{ __('Save') }}
        </x-button>
      </div>

    </form>
  </x-form-wrapper>
</x-site-layout>
