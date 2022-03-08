<div class="flex flex-row items-center mb-1 bg-gray-100 p-2 rounded">
  <div class="basis-1/4">
    {{ $timeEntry->date->format('m/d/Y') }}
  </div>
  <div class="basis-1/4">
    {{ $timeEntry->user->name }}&nbsp;-&nbsp;{{ $timeEntry->displayDuration }}
  </div>
  <div class="basis-1/4">
    {{ $timeEntry->task->name }} @ ${{ $timeEntry->task->displayRate }}/hr
  </div>
  <div class="basis-1/4">
    <strong>${{ $timeEntry->totalDisplay }}</strong>
  </div>
</div>
