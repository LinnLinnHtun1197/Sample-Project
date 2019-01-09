<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    <link rel="icon" href="../../favicon.ico">

    @yield('title')

    @include('layouts.css')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.css')}}">


</head>

<body role="document">

@include('layouts.nav')


<div class="container theme-showcase" role="main">

    @yield('content')

@include('layouts.bottom')
</div>

@include('layouts.scripts')



</body>
</html>