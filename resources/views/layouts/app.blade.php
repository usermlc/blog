<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding to UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensure proper scaling on mobile devices -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Compatibility for Internet Explorer -->
    <title>@yield('title', 'Blog on Slim')</title> <!-- Yield a section for the page title, with a default value -->
    <link rel="stylesheet" href="{{ '/css/style.css' }}"> <!-- Link to the external CSS file -->
</head>
<body>
<header class="header">
    @yield('header') <!-- Yield a section for the header -->
</header>
<main class="main">
    @yield('content') <!-- Yield a section for the main content -->
</main>
<footer class="footer">
    Blog on SLIM
</footer>
</body>
</html>
