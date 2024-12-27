<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Online Quiz')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body  {
            background: linear-gradient(to right,rgba(9,121,187,255), rgba(115,86,183,255));
            color: white;
            min-height: 100vh;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="my-4 text-center">
            <h1>Online Quiz</h1>
        </header>

        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
