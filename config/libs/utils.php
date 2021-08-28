<?php

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
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

  public static function isvalid_ip_address($ip): bool
  {
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
      return false;
    }
    return true;
  }

  public static function get_location_from_ip($ip): string
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

  public static function default_image($filename, $size = null): string
  {
    $url = self::default_url($filename);
    if($size != null) {
      return "{$url}&size={$size}";
    } else {
      return $url;
    }
  }

  private static function default_url($filename): string
  {
    $key = self::get_token()["drive"];
    $host = $_SESSION["conn"]["agency"]["cname"];
    return "https://db.getnaprog.com/api/v1/{$filename}?key={$key}&h={$host}";
  }

  private static function get_token(): array
  {
    $file = $_SERVER["DOCUMENT_ROOT"] . "/priv/server/credentials.json";
    if (file_exists($file)) {
      $token = file_get_contents($file);
      return json_decode($token, true);
    } else {
      exit("Cannot read key file.");
    }
  }

  public static function upload_file_ftp(array $obj, int $mode = FTP_BINARY): void
  {
    #- Prepare upload all attachment to drive
    $agency_cname = $_SESSION["conn"]["agency"]["cname"];
    $tmp_dir = $_SERVER["DOCUMENT_ROOT"] . "/priv/temp";
    $id = $obj["{$obj['kind']}_id"];

    $f_name = "{$obj['kind']}:{$obj['title']}:{$id}:{$obj['name']}";
    $tmp_path = "{$tmp_dir}/{$f_name}";

    #- Move file to temp directory
    move_uploaded_file($obj["tmp_name"], $tmp_path);

    $target = "/priv/drive/{$agency_cname}";

    #- Upload with FTP
    @FtpHandler::upload_file($tmp_dir, $target, $mode) or die("Cannot upload file {$obj['name']}");

    FileHandler::delete_file("priv/temp/{$f_name}");
  }

  public static function permitted(int $user_id): bool
  {
    if ($_SESSION["conn"]["current_user"]["id"] === $user_id || $_SESSION["conn"]["current_user"]["role"] >= 3)
      return true;
    else
      return false;
  }
}