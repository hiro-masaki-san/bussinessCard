<html lang="en-US">
<head>
  <meta charset="utf-8">
    <title>@yield('title')</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @yield('css')
    @yield('header')

</head>

<body>
    @yield('content')
    @yield('js')
</body>
