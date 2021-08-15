<?php

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToWriteFile;
use League\Flysystem\UnableToReadFile;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\UnableToDeleteDirectory;
use League\Flysystem\UnableToCreateDirectory;
use League\Flysystem\UnableToMoveFile;
use League\Flysystem\UnableToCopyFile;
use League\MimeTypeDetection\FinfoMimeTypeDetector;

class FileHandler
{
  private static function setup()
  {
    $adapter = new LocalFilesystemAdapter(
      // Determine the root directory
      $_SERVER["DOCUMENT_ROOT"] . "/priv/data/",

      // Customize how visibility is converted to unix permissions
      PortableVisibilityConverter::fromArray([
        'file' => [
          'public' => 0744,
          'private' => 0700,
        ],
        'dir' => [
          'public' => 0755,
          'private' => 0700,
        ]
      ]),

      // Write flags
      LOCK_EX,

      // How to deal with links, either DISALLOW_LINKS or SKIP_LINKS
      // Disallowing them causes exceptions when encountered
      LocalFilesystemAdapter::DISALLOW_LINKS
    );

    $filesystem = new Filesystem($adapter, ["visibility" => "public"]);
    return $filesystem;
  }

  public static function write_file($path, $contents, $config = [])
  {
    try {
      self::setup()->write($path, $contents, $config);
      return true;
    } catch (FilesystemException | UnableToWriteFile $exception) {
      return "Unable to write: " . $exception;
    }
  }

  public static function read_file($path)
  {
    try {
      $response = self::setup()->read($path);
      return $response;
    } catch (FilesystemException | UnableToReadFile $exception) {
      return "Unable to read: " . $exception;
    }
  }

  public static function delete_file($path)
  {
    try {
      self::setup()->delete($path);
      return true;
    } catch (FilesystemException | UnableToDeleteFile $exception) {
      return "Unable to delete file: " . $exception;
    }
  }

  public static function delete_dir($path)
  {
    try {
      self::setup()->deleteDirectory($path);
      return true;
    } catch (FilesystemException | UnableToDeleteDirectory $exception) {
      return "Unable to delete directory: " . $exception;
    }
  }

  public static function create_dir($path, $config = [])
  {
    try {
      self::setup()->createDirectory($path, $config);
      return true;
    } catch (FilesystemException | UnableToCreateDirectory $exception) {
      return "Unable to create directory: " . $exception;
    }
  }

  public static function move_file($source, $destination, $config = [])
  {
    try {
      self::setup()->move($source, $destination, $config);
      return true;
    } catch (FilesystemException | UnableToMoveFile $exception) {
      return "Unable to move file: " . $exception;
    }
  }

  public static function copy_file($source, $destination, $config = [])
  {
    try {
      self::setup()->copy($source, $destination, $config);
    } catch (FilesystemException | UnableToCopyFile $exception) {
      return "Unable to copy file: " . $exception;
    }
  }

  public static function mime_content_type($path)
  {
    $detector = new FinfoMimeTypeDetector();
    $mimeType = $detector->detectMimeTypeFromFile($path);
    return $mimeType;
  }
}
