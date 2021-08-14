<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kitisak Sapphaniran">
    <title>Reaml Admin -- Content Management System</title>
    <link rel="icon" href="<?= r ?>assets/statics/favicon.ico" type="image/x-icon">
    <link href="<?= r ?>assets/css/app.css" rel="stylesheet">
    <script src="<?= r ?>assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?= r ?>assets/js/app.js"></script>
    <script>window.csrf = { token: '<?= $_SESSION['token'] ?>' };</script>
</head>
<body class="bg-gray-100 font-mono">