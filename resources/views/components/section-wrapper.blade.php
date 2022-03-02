<div {{ $attributes->merge(['class' => 'max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8']) }}>
  <h2 class="text-slate-900 mb-3 mt-4 text-sm uppercase tracking-tight sm:text-md dark:text-white">
    {{ $title ?? '' }}
  </h2>
  {{ $slot }}
</div>
