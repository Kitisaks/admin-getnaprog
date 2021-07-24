<?php
    require_once "../../config.php";

    try {
        $conn = new PDO("mysql:host=".DB_SERVER, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //- change database name ++
        $sql = "CREATE DATABASE school_dev";

        $conn->exec($sql);
        echo "Database created successfully<br>";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
?>