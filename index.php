<?php
//== FOR PRODUCTIONS ==//
http_response_code(404);
switch (http_response_code()) {
    case 200:
        switch (isset($_SERVER["HTTPS"])) {
            case true:
                //- set more secure please
                header("Location: /view/home.php");
                break;
            default:
                header("Location: error.php");
                break;
        }
        break;
    default:
        header("Location: error.php");
        break;
}

//== FOR DEVELOPEMENT ==/ 
//-- comment the code above out --//
// header("Location: /view/home.php");
