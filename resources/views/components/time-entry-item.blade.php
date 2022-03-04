<div class="flex flex-row items-center mb-1 bg-gray-100 p-2 rounded">
  <div class="basis-1/4">
    <h3 class="pl-2">{{ $timeEntry->user->name }}</h3>
  </div>
  <div class="basis-1/4">
    <div class="flex flex-row-reverse">
      {{ $timeEntry->duration }}
    </div>
  </div>
</div>
