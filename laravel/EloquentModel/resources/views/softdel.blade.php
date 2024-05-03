<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach($flights as $flight)
    <p>{{ $flight->name }} - {{ $flight->departure }} to {{ $flight->destination }}</p>
    <form action="{{ route('flights.destroy', $flight->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    @if($flight->trashed())
        <form action="{{ route('flights.restore', $flight->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">Restore</button>
        </form>
    @endif
@endforeach
</body>

</html>
