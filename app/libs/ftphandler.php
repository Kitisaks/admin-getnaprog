<?php
namespace App\Libs;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use \FtpClient\FtpClient;

class FtpHandler
{
  private static function _connect()
  {
    $ftp = new FtpClient();
    $ftp->connect(FTP['hostname'], FTP['ssl'], FTP['port'], FTP['timeout']);
    $ftp->login(FTP['username'], FTP['password']);
    if (FTP['mode'] === 'passive')
      $ftp->pasv(true);
    else if (FTP['mode'] === 'active')
      $ftp->pasv(false);
    return $ftp;
  }

  public static function help(): array
  {
    return self::_connect()->help();
  }

  public static function list(string $path = '')
  {
    return self::_connect()->scanDir($path);
  }

  public static function size(string $path = '')
  {
    return self::_connect()->dirSize($path). ' byte';
  }

  public static function upload_file(string $source, string $target, int $mode = FTP_BINARY)
  {
    if (self::_connect()->putAll($source, $target, $mode))
      return true;
    else
      return false;  
  }
  
}
