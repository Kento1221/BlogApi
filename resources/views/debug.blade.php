<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

</head>
<body class="antialiased">
<h1>{{$author['name'].' '.$author['surname']}}</h1>

@foreach($author->articles as $article)
    <p>{{$article['title']}}</p>
@endforeach
</body>
</html>
