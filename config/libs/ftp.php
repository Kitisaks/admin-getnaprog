<?php

class FtpHandler
{
  private static $adapter = [
    "host" => "getnaprog.com",
    "username" => "admin@getnaprog.com",
    "password" => "@Fluke160941"
  ];

  private static function connect()
  {
    $ftp_conn = 
      ftp_connect(self::$adapter["host"]) 
      or die("Could not connect to ".self::$adapter["host"]);
    @ftp_login(
      $ftp_conn,
      self::$adapter["username"], 
      self::$adapter["password"]
    );
    return $ftp_conn;
  }

  public static function list()
  {
    $lists = ftp_nlist(self::connect(), "");
    ftp_close(self::connect());
    return $lists;
  }

  
  
}
