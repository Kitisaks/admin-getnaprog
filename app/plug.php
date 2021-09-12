<?php

namespace App;

class Plug
{
  function __construct()
  {
    $this->repo = new Repo();
  }

  protected function paginate($params, $query, string $table, int $num_per_page = 30)
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
      ->view
      ->assign('current_page', $current_page)
      ->assign('total_of_page', $total_of_page['num'])
      ->assign('num_current_pages', $num_current_page)
      ->assign('num_next_page', $num_current_page + $num_per_page);

    return $results;
  }
}
