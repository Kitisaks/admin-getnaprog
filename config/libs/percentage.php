<?php
use Mattiasgeniar\Percentage\Percentage;

class MathPercentage
{
  public static function find($a, $b)
  {
    return Percentage::calculate($a, $b); 
  }

  public static function percent_of($a, $b)
  {
    return Percentage::of($a, $b); 
  }

  public static function diff($a, $b)
  {
    return Percentage::absoluteDifferenceBetween($a, $b);
  }
}