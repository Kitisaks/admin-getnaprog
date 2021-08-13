<?php
use Ramsey\Uuid\Uuid;

class GenUuid
{
  public static function uuid1()
  {
    $uuid = Uuid::uuid1();
    return $uuid->toString();
  }

  public static function uuid4()
  {
    $uuid = Uuid::uuid4();
    return $uuid->toString();
  }

  public static function uuid6()
  {
    $uuid = Uuid::uuid6();
    return $uuid->toString();
  }
}
