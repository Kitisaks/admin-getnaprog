<?php
################# Libraries Includes ########################



#############################################################

#- use to declare the libraries for your app. // Static function
class Utils
{

  public static function check_current_user()
  {
    if (empty($_SESSION["current_user"])) {
      header("location: /auth");
      exit;
    }
  }

  public static function validate_phone_number($phone)
  {
    $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
    if (strlen($phone_to_check) < 9 || strlen($phone_to_check) > 14) {
      return false;
    } else {
      return true;
    }
  }

  public static function get_client_ip()
  {
    if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
      $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

  public static function isvalid_ip_address($ip)
  {
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
      return false;
    }
    return true;
  }

  public static function get_location_from_ip($ip)
  {
    $ch = curl_init('http://ip-api.com/json/' . $ip);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    // Decode JSON response
    $address = json_decode($json, true);
    // Country code output, field "country_code"

    return $address;
  }

  public static function ftp_init()
  {
    $host = "getnaprog.com";
    $user = "getnapro_admin@getnaprog.com";
    $password = "@Fluke160941";
    $ftp = new \FtpClient\FtpClient();
    $ftp->connect($host);
    $ftp->login($user, $password);
    return $ftp;
  }
}
