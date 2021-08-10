<?php
#- declare your first redirect home page.
require_once "./config/config.php";

switch (MODE) {
    case "PRO":
        switch (isset($_SERVER["HTTPS"])) {
            case true:
                header("Location: /auth");
                break;
            default:
                header("Location: /error");
                break;
        }
        break;
    case "DEV":
        header("Location: /auth");
        break;
}
