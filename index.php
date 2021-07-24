<?php
    
    //== FOR PRODUCTIONS ==//
    
    // if (isset($_SERVER["HTTPS"])) {
    //     //- ser more secure please
    //     header("Location: /view/home.php");
    //     exit;
    // }else{
    //     echo "<h4>Your connection is not <span style='color: red'>SECURE!</span> please use https:// instead.</h4>";
    // }

    //== FOR DEVELOPEMENT ==/ 
    //-- comment the code above out --//
    
    header("Location: /view/home.php");
?>