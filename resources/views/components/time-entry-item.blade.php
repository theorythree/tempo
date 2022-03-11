<div class="flex flex-row items-center mb-1 bg-gray-100 p-2 rounded">
  <div class="basis-1/4">
    {{ $timeEntry->date->format('m/d/Y') }}&nbsp;-&nbsp;{{ $timeEntry->user->name }}
  </div>
  <div class="basis-1/4">
    {{ $timeEntry->displayDuration }}&nbsp;-&nbsp;{{ $timeEntry->task->name }}
  </div>
  <div class="basis-1/4">
    @ {{ $timeEntry->task->displayRate }}/hr
  </div>
  <div class="basis-1/4 text-right">
    <strong>{{ $timeEntry->totalDisplay }}</strong>
  </div>
</div>
