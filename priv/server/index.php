<?php
require_once "../../vendor/autoload.php";

#- Setup
$host = "getnaprog.com";
$user = "getnapro";
$password = "@Fluke160941";
$source_directory = "../../";
$target_directory = "/public_html/admin/";

$ftp = new \FtpClient\FtpClient();
$ftp->connect($host);
$ftp->login($user, $password);

#- Upload all files
var_dump($ftp->putAll($source_directory, $target_directory));
echo "Already Deployed! see at <a href='https://admin.getnaprog.com'>admin.getnaprog.com</a>";