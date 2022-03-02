<div class="flex flex-row items-center mb-1 bg-gray-100 p-2 rounded">
  <div class="basis-3/4">
    <h3 class="pl-2">{{ $project->name }}</h3>
  </div>
  <div class="basis-1/4">
    <div class="flex flex-row-reverse">
      <x-button-link href="{{ route('projects.show', $project->id) }}">
        View
      </x-button-link>
      @if (Auth::user()->can('update', $project))
        <x-button-link href="{{ route('projects.edit', $project->id) }}">
          Edit
        </x-button-link>
      @endif
    </div>
  </div>
</div>
