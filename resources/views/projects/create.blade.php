<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create a Project for {{ $client->name }}</title>
</head>

<body>
  <form action="{{ route('projects.store') }}" method="POST">
    <input type="hidden" name="client_id" value="{{ $client->id }}" />
    <input type="text" name="name" id="name" placeholder="Name of the Project" required><br />
    <input type="text" name="budget" id="budget" placeholder="Budget in US Dollars"><br />
    <textarea name="description" id="description" cols="30" rows="10"
      placeholder="Project Description"></textarea><br />
    <input type="submit" value="Submit">
  </form>
</body>

</html>