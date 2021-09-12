<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="author" content="Kitisak Sapphaniran">
    <meta name="csrf-token" content="<?= $_SESSION["_csrf_token"] ?>">
    <title>Reaml Admin -- Content Management System</title>
    <link rel="icon" href="<?= BASE_URL ?>assets/statics/favicon.ico" type="image/x-icon">
    <?php App\View::assets_include() ?>
</head>
<body class="bg-gray-100 font-sans antialiased proportional-nums tracking-normal leading-normal list-inside align-middle">
