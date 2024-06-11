<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('front.layouts.head')
</head>
<body>
    @include('front.layouts.navbar')
    @include('front.layouts.hero')

    <main id="main">
       @yield('content')
    </main><!-- End #main -->

    @include('front.layouts.footer')
    @include('front.layouts.bottom')
</body>
</html>