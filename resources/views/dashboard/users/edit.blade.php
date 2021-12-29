<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update a Project for {{ $project->client->name }}</title>
</head>

<body>
  <form action="{{ route('projects.update', $project->id) }}">
    @method('put')
    <input type="text" name="name" id="name" value="{{ $project->name }}" placeholder="Name of the Project" required>
    <input type="text" name="budget" id="budget" value="{{ $project->budget }}" placeholder="Budget in US Dollars">
    <textarea name="description" id="description" cols="30" rows="10" placeholder="Project Description">
      {{ $project->description }}
    </textarea>
    <input type="submit" value="Submit">
  </form>
</body>

</html>