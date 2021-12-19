<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $project->name }}</title>
</head>

<body>
  <a href="{{ route('projects.index') }}">Back to Project List</a>
  <h1>{{ $project->name }}</h1>
  <p>Client: {{ $project->client->name }} | Budget: ${{ $project->budget }}</p>

  <h2>Project Description</h2>
  <p>{{ $project->description }}</p>

</body>

</html>