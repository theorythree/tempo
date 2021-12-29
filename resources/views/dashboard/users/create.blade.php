<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Tempo Dashboard: Create a User') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="{{ route('dashboard.users.store') }}" method="POST">
          @csrf
          <!-- Name -->
          <div>
            <x-label for="name" :value="__('Name')" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
          </div>

          <!-- Email Address -->
          <div class="mt-4">
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
          </div>

          <!-- Password -->
          <div class="mt-4">
            <x-label for="password" :value="__('Password')" />
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
              autocomplete="new-password" />
          </div>

          <!-- Confirm Password -->
          <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
              required />
          </div>

          <div class="mt-4">
            <x-label for="password_confirmation" :value="__('User Primary Role')" />

            <select name="role_id" id="" class="block mt-1 w-full" required>
              <option value="">Select...</option>
              @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ ucwords($role->name) }}</option>
              @endforeach
            </select>
          </div>

          <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
              {{ __('Register') }}
            </x-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
