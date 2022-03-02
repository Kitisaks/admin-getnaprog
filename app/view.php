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

  private function _replace_app_space($folder, $page)
  {
    return str_replace(
      '//',
      '/',
      str_replace(
        'app\\\\',
        DIRECTORY_SEPARATOR,
        $_SERVER['DOCUMENT_ROOT'] . "/templates/{$folder}/{$page}.php"
      )
    );
  }

  private function _require(string $page, string $folder = 'layout')
  {
    require $this->_replace_app_space($folder, $page);
  }

  private function _get_content(string $page, string $folder = 'layout')
  {
    $file = file_get_contents($this->_replace_app_space($folder, $page)); 
    ob_start();
    eval('?>'.$file.'<?php ');
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }

  public function render($pages)
  {
    if ($this->_layout) {
      $this
        ->assign('@inner_content@', $this->_get_content($pages, $this->main))
        ->_require('app.html', 'layout');
    } else {
      $this->_require($pages, $this->main);
    }
  }

  public static function assets_include()
  {
    $base = $_SERVER['DOCUMENT_ROOT'];
    if (MODE == 'DEV')
      $filepath = 'assets/';
    else
      $filepath = 'priv/statics/';

    $css = array_filter(array_slice(scandir($base . '/' . $filepath . 'css/'), 2), fn ($i) => str_ends_with($i, '.css'));
    $js = array_filter(array_slice(scandir($base . '/' . $filepath . 'js/'), 2), fn ($i) => str_ends_with($i, '.js'));

    foreach ($css as $i) {
      echo "\t" . '<link rel="stylesheet" type="text/css" href="' . '/' . $filepath . 'css/' . $i . '">' . "\n";
    }
    foreach ($js as $i) {
      echo "\t" . '<script defer type="text/javascript" src="' . '/' . $filepath . 'js/' . $i . '"></script>' . "\n";
    }
  }

  public static function partial($view, $pages)
  {
    $view = str_replace('view', '', strtolower($view));
    if (is_array($pages)) {
      foreach ($pages as $page) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/templates/{$view}/{$page}.php";
      }
    } else {
      require_once $_SERVER['DOCUMENT_ROOT'] . "/templates/{$view}/{$pages}.php";
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

  public function redirect(string $uri = null)
  {
    header("location: {$uri}");
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