<x-site-layout>
  <x-form-wrapper>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('clients.store') }}">
      @csrf

      <div class="flex flex-row">
        <div class="basis-1/2 mr-4">
          <x-label for="name" :value="__('Name')" />
          <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
            value="{{ old('name') ?? '' }}" required />
        </div>
        <div class="basis-1/2 ml-4">
          <x-label for="code" :value="__('Code')" />
          <x-input id="code" class="block mt-1 w-sm" type="text" name="code" :value="old('code')"
            value="{{ old('code') ?? '' }}" required />
        </div>
      </div>

      <div class="flex flex-row mt-4">
        <div class="basis-1/2 mr-4">
          <x-label for="address" :value="__('Address')" />
          <x-input-textarea id="address" class="block mt-1 w-full" type="text" name="address">
            {{ old('address') ?? '' }}</x-input-textarea>
        </div>
        <div class="basis-1/2 ml-4">
          <x-label for="phone" :value="__('Phone')" />
          <x-input id="phone" class="block mt-1 w-sm" type="text" name="phone" :value="old('phone')"
            value="{{ old('phone') ?? '' }}" />
        </div>
      </div>

      <div class="flex items-center justify-start mt-4">
        <x-button-link href="{{ route('clients.index') }}">
          {{ __('Cancel') }}
        </x-button-link>
        <x-button>
          {{ __('Save') }}
        </x-button>
      </div>

    </form>
  </x-form-wrapper>
</x-site-layout>
