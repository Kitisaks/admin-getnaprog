<?php

namespace App;

use App\Repo;

class View
{
  public $main;
  private $_layout;

  public function __construct($main)
  {
    $this->repo = new Repo();
    $this->main = str_replace('controller', '', strtolower($main));
    $this->_layout = true;
  }

  private function _require(string $page, string $folder = 'layout')
  {
    $path = $_SERVER['DOCUMENT_ROOT'] . "/templates/{$folder}/{$page}.php";
    $path = str_replace('app\\\\', DIRECTORY_SEPARATOR, $path);
    require_once $path;
  }

  public function render($pages)
  {
    if ($this->_layout) {
      if (is_string($pages)) {
        $this->_require('header.html');
        $this->_require('_alert.html');
        $this->_require('_notice.html');
        $this->_require('_popup.html');
        $this->_require('_navbar.html');
        $this->_require($pages, $this->main);
        $this->_require('_footer.html');
        $this->_require('bottom.html');
      } else if (is_array($pages)) {
        $this->_require('header.html');
        $this->_require('_alert.html');
        $this->_require('_notice.html');
        $this->_require('_popup.html');
        $this->_require('_navbar.html');
        foreach ($pages as $page) {
          $this->_require($page, $this->main);
        }
        $this->_require('_footer.html');
        $this->_require('bottom.html');
      }
    } else {
      if (is_string($pages)) {
        $this->_require('header.html');
        $this->_require('_alert.html');
        $this->_require('_notice.html');
        $this->_require('_popup.html');
        $this->_require($pages, $this->main);
        $this->_require('bottom.html');
      } else if (is_array($pages)) {
        $this->_require('header.html');
        $this->_require('_alert.html');
        $this->_require('_notice.html');
        $this->_require('_popup.html');
        foreach ($pages as $page) {
          $this->_require($page, $this->main);
        }
        $this->_require('bottom.html');
      }
    }
  }

  public static function assets_include()
  {
    $base = $_SERVER['DOCUMENT_ROOT'];
    if (MODE == 'DEV')
      $filepath = 'assets/';
    else
      $filepath = 'priv/statics/';

    $css = array_slice(scandir($base . '/' . $filepath . 'css/'), 2);
    $js = array_slice(scandir($base . '/' . $filepath . 'js/'), 2);

    foreach ($css as $i) {
      echo "\t" . '<link rel="stylesheet" type="text/css" href="' . BASE_URL . $filepath .'css/' . $i . '">' . "\n";
    }
    foreach ($js as $i) {
      echo "\t" . '<script defer type="text/javascript" src="' . BASE_URL . $filepath . 'js/' . $i . '"></script>' . "\n";
    }
  }

  public static function partial($main, $pages)
  {
    $path = $_SERVER['DOCUMENT_ROOT'];
    if (is_array($pages)) {
      foreach ($pages as $page) {
        require_once $path . "/templates/{$main}/{$page}.php";
      }
    } else {
      require_once $path . "/templates/{$main}/{$pages}.php";
    }
  }

  public function put_layout(bool $layout)
  {
    $this->_layout = $layout;
    return $this;
  }

  public function assign(string $param, $value)
  {
    $GLOBALS[$param] = $value;
    return $this;
  }

  public function put_flash(bool $status = true, $value)
  {
    if ($status)
      $_SESSION['popup'] = ['status' => 1, 'info' => $value];
    else
      $_SESSION['popup'] = ['status' => 0, 'info' => $value];
    return $this;
  }

  public function redirect(string $uri = null)
  {
    header("location: {$uri}");
    exit;
  }

  public function return(string $type = 'default', array $data)
  {
    switch ($type) {
      case 'default':
        echo $data;
        break;
      case 'json':
        echo json_encode($data, JSON_THROW_ON_ERROR);
        break;
    }
    exit;
  }

  public function send_resp_code(int $code)
  {
    http_response_code($code);
    exit;
  }

  public function paginate($params, $query, string $table, int $num_per_page = 30)
  {
    # Filter input
    if (is_null($query))
      return null;

    if (isset($params['p']) && !is_null($params['p'])) {
      $current_page = intval($params['p']);
      $num_current_page = ($current_page - 1) * $num_per_page;
      $results =
        $query
        ->limit([$num_current_page, $num_current_page + $num_per_page])
        ->all();
    } else {
      $current_page = 1;
      $num_current_page = ($current_page - 1) * $num_per_page;
      $results =
        $query
        ->limit([0, $num_per_page])
        ->all();
    }
    $total_of_page =
      $this
      ->repo
      ->select('count(id) as num')
      ->from($table)
      ->one();

    # Assign indicator for paginate page
    $this
      ->assign('current_page', $current_page)
      ->assign('total_of_page', $total_of_page['num'])
      ->assign('num_current_pages', $num_current_page)
      ->assign('num_next_page', $num_current_page + $num_per_page);

    return $results;
  }
}
