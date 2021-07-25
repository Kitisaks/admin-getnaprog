<?php
//== SECLECT MODE ==//
#- ["dev", "pro"]
$mode = "dev" ;
http_response_code(404);
switch ($mode) {
    case "pro":
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
    case "dev":
        header("Location: /home");
        break;
}

