<?php

namespace App\Libs;
#- use to declare the libraries for your app. // Static function
class Utils
{
  public static function validate_phone_number($phone): bool
  {
    $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
    if (strlen($phone_to_check) < 9 || strlen($phone_to_check) > 14) {
      return false;
    } else {
      return true;
    }
  }

  public static function get_client_ip(): string
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
      $ipaddress = 'Unknown';
    return $ipaddress;
  }

  public static function isvalid_ip_address($ip): bool
  {
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
      return false;
    }
    return true;
  }

  public static function get_location_from_ip($ip)
  {
    if (self::isvalid_ip_address($ip)) {
      $ch = curl_init('http://ip-api.com/json/' . $ip);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $json = curl_exec($ch);
      curl_close($ch);
      // Decode JSON response
      $address = json_decode($json);
      // Country code output, field "country_code"
      return $address;
    } else {
      return 'Unknown';
    }
  }

  public static function read_json_file(string $path): array
  {
    if (file_exists($path)) {
      $file = file_get_contents($path);
      return json_decode($file, true);
    } else {
      exit('Cannot read the file.');
    }
  }

  public static function base_url(): string
  {
    return  sprintf(
      '%s://%s/',
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME']
    );
  }

  public static function is_json(string $string): bool
  {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
  }

  public static function encrypt_sha256(string $pswd)
  {
    return hash_hmac("sha256", $pswd, PEPPER_KEY);
  }
}
