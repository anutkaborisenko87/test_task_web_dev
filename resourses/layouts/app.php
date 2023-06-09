<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/fonts.css">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <script src="/public/js/jQuery3-5-1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/public/js/popper1-16-1.min.js"></script>
    <script src="/public/js/bootstrap4-6-0.min.js"></script>
    <script src="/public/js/main.js"></script>
</head>
<body>
<div class="container">
    <h1><?= $site_name ?></h1>
    {{ content }}
</div>
</body>
</html>