<?php
namespace App\Data;
use App\Libs\YamlHandler;
use App\Libs\FtpHandler;
use App\Libs\FileHandler;

class Attachment
{
  private static function do_image($image, $size)
  {
    $filename = "{$image['kind']}:{$image['title']}:{$image['id']}:{$image['name']}";
    $url = self::default_url($filename);
    if ($size != null) {
      return "{$url}&size={$size}";
    } else {
      return $url;
    }
  }

  public static function default_images($attachments = null, $post_id, $size = null): string
  {
    if (!is_null($attachments)) {
      $image = array_filter(
        $attachments,
        function ($attachment) use ($post_id) {
          return $attachment['id'] === $post_id;
        }
      );
      $image = array_values($image)[0];
      return self::do_image($image, $size);
    } else {
      return false;
    }
  }

  public static function default_image($attachment = null, $size = null): string
  {
    if (!is_null($attachment))
      return self::do_image($attachment, $size);
    else
      return false;
  }

  public static function attach(array $obj, string $title)
  {
    if ($obj['a_title'] === $title) {
      $data = array_filter(
        [
          'id' => $obj['p_id'],
          'title' => $obj['a_title'],
          'name' => $obj['a_name'],
          'kind' => $obj['a_kind'],
        ],
        function ($d) {
          return $d !== null;
        }
      );
      if ($data !== [])
        return $data;
    }
  }

  public static function attach_many(array $obj, string $title)
  {
    $data = array_filter(
      array_map(
        function ($item) use ($title) {
          if ($item['a_title'] === $title)
            return [
              'id' => $item['p_id'],
              'title' => $item['a_title'],
              'name' => $item['a_name'],
              'kind' => $item['a_kind'],
            ];
        },
        $obj
      ),
      function ($d) {
        return $d !== null;
      }
    );
    if ($data !== [])
      return $data;
  }

  private static function default_url(string $filename): string
  {
    $key = YamlHandler::parsefile($_SERVER['DOCUMENT_ROOT'] . '/app/config.yml')['api']['drive'];
    $host = $_SESSION['conn']['agency']['cname'];
    return "https://db.getnaprog.com/api/v1/{$filename}?key={$key}&h={$host}";
  }

  public static function upload_file_ftp(array $obj, int $mode = FTP_BINARY): void
  {
    #- Prepare upload all attachment to drive
    $agency_cname = $_SESSION['conn']['agency']['cname'];
    $tmp_dir = $_SERVER['DOCUMENT_ROOT'] . '/priv/temp';
    $id = $obj["{$obj['kind']}_id"];

    $f_name = "{$obj['kind']}:{$obj['title']}:{$id}:{$obj['name']}";
    $tmp_path = "{$tmp_dir}/{$f_name}";

    #- Move file to temp directory
    move_uploaded_file($obj['tmp_name'], $tmp_path);

    $target = "/priv/drive/{$agency_cname}";

    #- Upload with FTP
    @FtpHandler::upload_file($tmp_dir, $target, $mode) or die("Cannot upload file {$obj['name']}");

    FileHandler::delete_file("priv/temp/{$f_name}");
  }
}
