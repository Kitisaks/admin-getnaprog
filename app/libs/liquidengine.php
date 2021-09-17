<?php
namespace App\Libs;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use Liquid\Template;

class LiquidEngine
{
  private $_template;

  function __construct()
  {
    $this->_template = new Template();
  }

  public function parse(string $html)
  {
    $this->_template->parse($html);
    return $this;
  }

  public function render(array $object)
  {
    return $this->_template->render($object);
  }
}