<main class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen">
  <!-- Content goes here -->
  HOME
  <br>

  <?php
  $i = 0.0000001555000000000;
  $b = rtrim($i, 0);
  function get_readable($num) {
    $num = $num + 1;
    return '0'.ltrim($num, 1);
  }
  print_r(get_readable($b));
  ?>

  <br>
  <br>
</main>
