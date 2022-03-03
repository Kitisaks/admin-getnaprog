<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="author" content="<?= SITE["author"] ?? "DEVED-FRAMEWORK" ?>">
    <meta name="csrf_token" content="<?= $_SESSION["_csrf_token"] ?>">
    <title><?= SITE["title"] ?></title>
    <link rel="icon" href="/assets/statics/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <?= App\View::assets_include() ?>
</head>

<body>
  <?= $GLOBALS["@inner_content@"] ?>
</body>

</html>