<?php
namespace App\Libs;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use SplTempFileObject;

class Csv
{
  public static function parse($path, $start, $end)
  {
    $csv = Reader::createFromPath($path, 'r');
    $csv->setHeaderOffset(0);
    $stmt = Statement::create()
        ->offset($start)
        ->limit($end)
    ;
    return $stmt->process($csv);
  }

  public static function export($data, $header = [], $name)
  {
    $csv = Writer::createFromFileObject(new SplTempFileObject());
    $csv->insertOne($header);
    $csv->insertAll($data);
    $csv->output($name . '.csv');
    die;
  }
}