<?php
use \FtpClient\FtpClient;

class FtpHandler
{
  private static $adapter = [
    "hostname" => "getnaprog.com",
    "username" => "db@getnaprog.com",
    "password" => "@Fluke160941",
    "mode" => "passive", //passive or active
    "ssl" => false,
    "port" => 21,
    "timeout" => 30
  ];

  private static function connect()
  {
    $ftp = new FtpClient();
    $ftp->connect(self::$adapter["hostname"], self::$adapter["ssl"], self::$adapter["port"], self::$adapter["timeout"]);
    $ftp->login(self::$adapter["username"], self::$adapter["password"]);
    if (self::$adapter["mode"] === "passive")
      $ftp->pasv(true);
    else if (self::$adapter["mode"] === "active")
      $ftp->pasv(false);
    return $ftp;
  }

  public static function help(): array
  {
    return self::connect()->help();
  }

  public static function list(string $path = "")
  {
    return self::connect()->scanDir($path);
  }

  public static function size(string $path = "")
  {
    return self::connect()->dirSize($path). " byte";
  }

  public static function upload_file(string $source, string $target, int $mode = FTP_BINARY)
  {
    if (self::connect()->putAll($source, $target, $mode))
      return true;
    else
      return false;  
  }
  
}
