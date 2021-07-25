<?php
require_once "./config/config.php";

switch (MODE) {
    case "PRO":
        switch (isset($_SERVER["HTTPS"])) {
            case true:
                //- set more secure please
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

