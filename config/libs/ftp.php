<?php
use \FtpClient\FtpClient;

class Ftp
{

  public static function setup()
  {
    $host = "getnaprog.com";
    $user = "getnapro_admin@getnaprog.com";
    $password = "@Fluke160941";
    $ftp = new FtpClient();
    $ftp->connect($host);
    $ftp->login($user, $password);
    return $ftp;
  }

  public static function help()
  { 
    $ftp = self::setup();
    var_dump($ftp->help());
  }

  public static function chmod($code , $file)
  {
    $ftp = self::setup();
    try {
      $ftp->chmod($code, $file);
      echo 'Finished change permission a file';
    } catch (Exception $e) {
      echo 'FatalError: ' . $e->getMessage();
    }
  }

  public static function rmdir($path)
  {
    $ftp = self::setup();
    try {
      $ftp->rmdir($path, true);
      echo 'Finished delete a folder';
    } catch (Exception $e) {
      echo 'FatalError: ' . $e->getMessage();
    }
  }

  public static function put_all($source_directory, $target_directory)
  {
    $ftp = self::setup();
    try {
      $ftp->putAll($source_directory, $target_directory);
      echo 'Finished upload all files';
    } catch (Exception $e) {
      echo 'FatalError: ' . $e->getMessage();
    }
  }

  public static function mkdir($path)
  {
    $ftp = self::setup();
    try {
      $ftp->mkdir($path, true);
      echo 'Finished create folder';
    } catch (Exception $e) {
      echo 'FatalError: ' . $e->getMessage();
    }
  }
}
