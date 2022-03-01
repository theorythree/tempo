<div {{ $attributes->merge(['class' => 'relative max-w-7xl mx-auto p-4']) }}>
  <h2 class="text-slate-900 mb-1 mt-4 text-lg tracking-tight font-extrabold sm:text-md dark:text-white">
    {{ $title }}
  </h2>
  {{ $slot }}
</div>
