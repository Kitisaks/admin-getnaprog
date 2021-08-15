<?php
use Carbon\Carbon;

class Timex
{
  public static function now($locale = null)
  {
    return Carbon::now($locale)->toDateTimeString();
  }

  public static function iso_format($datetime, $locale = null)
  {
    if ($locale == null){
      return Carbon::parse($datetime)->isoFormat('LLLL');
    } else {
      return Carbon::parse($datetime)->locale($locale)->isoFormat('LLLL');
    }
  }

  public static function diff($datetime)
  {
    return $datetime->diffForHumans();
  }

  public static function add($datetime, $num, $type)
  {
    return $datetime->add($num, $type);
  }
}