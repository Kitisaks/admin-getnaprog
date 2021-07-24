<?php
    
    //== FOR PRODUCTIONS ==//
    if (empty($_SERVER["HTTPS"])) {
        //- ser more secure please
        header("Location: /view/home.php");
        exit;
    }
?>