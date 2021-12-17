<html>
  <head>
    <title>Client Index Screen</title>
  </head>
  <body>
    @foreach($clients as $client)
      <p>Name: {{ $client->name }} | Code: {{ $client->code }} <a href="/clients/{{ $client->id }}">View</a></p>
    @endforeach
  </body>
</html>