<?php
require_once "./config/config.php";

switch (MODE) {
    case "PRO":
        switch (isset($_SERVER["HTTPS"])) {
            case true:
                //- set more secure please
                header("Location: /home");
                break;
            default:
                header("Location: error.php");
                break;
        }
        break;
    case "DEV":
        header("Location: /home");
        break;
}

