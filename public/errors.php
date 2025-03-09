<?php
$errors = [
    400 => [
        'title' => 'Bad Request',
        'icon' => 'fas fa-exclamation-triangle',
        'description' => 'Oops! Your request is invalid or malformed.'
    ],
    401 => [
        'title' => 'Unauthorized',
        'icon' => 'fas fa-lock',
        'description' => 'Oops! You are not authorized to access this page.'
    ],
    403 => [
        'title' => 'Forbidden',
        'icon' => 'fas fa-ban',
        'description' => 'Oops! You don\'t have permission to access this page.'
    ],
    404 => [
        'title' => 'Page Not Found',
        'icon' => 'fas fa-exclamation-circle',
        'description' => 'Oops! The page you\'re looking for doesn\'t exist.'
    ],
    500 => [
        'title' => 'Internal Server Error',
        'icon' => 'fas fa-server',
        'description' => 'Oops! Something went wrong on our server. Please try again later.'
    ],
];

$error_code = $_GET['error'] ?? 404;
$error = $errors[$error_code] ?? $errors[404];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $error['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8d7da;
        }

        .error-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .error-icon {
            font-size: 100px;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 72px;
            color: #dc3545;
            margin-bottom: 10px;
        }

        .error-message {
            font-size: 24px;
            color: #721c24;
            margin-bottom: 20px;
        }

        .btn-home {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            color: #ffffff;
            background-color: #dc3545;
            border-color: #dc3545;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-home:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="error-container">
            <div class="error-icon">
                <i class="<?= $error['icon'] ?>"></i>
            </div>
            <h1 class="error-title"><?= $error_code ?></h1>
            <h2 class="display-4"><?= $error['title'] ?></h2>
            <p class="error-message"><?= $error['description'] ?></p>
            <a href="/" class="btn btn-lg btn-home">Go to Homepage</a>
        </div>
    </div>
</body>

</html>