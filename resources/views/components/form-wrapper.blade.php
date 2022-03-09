<div {{ $attributes->merge(['class' => 'min-h-screen bg-gray-100']) }}>
  <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
    <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      {{ $slot }}
    </div>
  </div>
</div>
