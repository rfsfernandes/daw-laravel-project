<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')
@section('title', $title)
<body>
@yield('content')
</body>

</html>


