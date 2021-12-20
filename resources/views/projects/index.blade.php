<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Project List</title>
</head>

<body>

  @foreach($projects as $project)
  <p>
    Name: {{ $project->name }} | Client: {{ $project->client->name }} | Budget: ${{ $project->budget }}
    <a href="{{ route('projects.show',$project->id) }}">View Project</a>
  </p>
  @endforeach

</body>

</html>