<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo-sm.png')}}">
    @includeIf('admin.auth.partials.css')
</head>
<body>
@yield('content')
@includeIf('admin.auth.partials.js')
<!-- password addon init -->
<script src="{{asset('assets/js/pages/pass-addon.init.js')}}"></script>
</body>
</html>
