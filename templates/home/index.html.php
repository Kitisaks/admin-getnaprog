<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen">
  <!-- Content goes here -->
  <?php 
  $a = array(
  array("label"=> '2', "y"=> '0'),
  array("label"=> '3', "y"=> '0'),
  array("label"=> '4', "y"=> '0'),
  array("label"=> '5', "y"=> '0'),
  array("label"=> '6', "y"=> '0'),
  );
  $b = array(
    array("label"=> '2', "y"=> '117.65'),
    array("label"=> '3', "y"=> '138.630000'),
    array("label"=> '4', "y"=> '199.170000'),
    array("label"=> '5', "y"=> '171.290000'),
    );

  #- ['1', '0', '2', '0']
  function get_values(array $array)
  {
    $new_array = [];
    foreach ($array as $elmnt) {
      $new_array = array_merge($new_array, array_values($elmnt));
    }
    return $new_array;
  }

  #- [1 => '', 2 => '']
  function new_from(array $array)
  {
    foreach ($array as $k => $v) {
      if ($k % 2 === 0)
        $key[] = $v;
      else
        $val[] = $v;
    }
    return array_combine($key, $val);
  }

  #- Return given array form
  function re_form(array $array)
  {
    foreach ($array as $k => $v) {
      $new[] = ['label' => $k, 'y' => $v];
    }
    return $new;
  }

  $c = new_from(get_values($a));
  $d = new_from(get_values($b));
  $result = re_form(array_replace($c, $d));
  var_export($result);
  ?>
  <br>
  <br>
  <br>
</div>
