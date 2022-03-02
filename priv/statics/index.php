<?php
require_once '../../vendor/autoload.php';

use MatthiasMullie\Minify;

$dir = '../../assets';

function get_file(string $type)
{
  global $dir;
  $file = array_filter(
    array_slice(scandir($dir . "/{$type}/"), 2),
    fn ($n) => strpos(".{$type}", $n) !== true
  );
  return array_map(
    fn ($n) => $dir . "/{$type}/" . $n,
    $file
  );
}

echo '=========== Deploy assets ===========' . PHP_EOL;
$js = get_file('js');
$css = get_file('css');
echo 'JS to digest :';
print_r($js);
echo 'CSS to digest :';
print_r($css);

# Minify for css files
for ($i = 0; $i <= count($css) - 1; $i++) {
  if ($i == 0) {
    $minifier_css = new Minify\CSS($css[$i]);
  } else {
    $minifier_css->add($css[$i]);
  }
}
# Minify for js files
for ($i = 0; $i <= count($js) - 1; $i++) {
  if ($i == 0) {
    $minifier_js = new Minify\JS($js[$i]);
  } else {
    $minifier_js->add($js[$i]);
  }
}

# Delete old files
foreach (glob(__DIR__ . '/css/*') as $old) {
  if (is_file($old)) {
    echo 'deleted old CSS files => ' . $old . PHP_EOL;
    unlink($old);
  }
}
foreach (glob(__DIR__ . '/js/*') as $old) {
  if (is_file($old)) {
    echo 'deleted old JS files => ' . $old . PHP_EOL;
    unlink($old);
  }
}

$f_css = __DIR__ . '/css' . '/css_' . uniqid() . '.css';
$f_js = __DIR__ . '/js' . '/js_' . uniqid() . '.js';

$minifier_css->minify($f_css);
$minifier_js->minify($f_js);

echo 'digested => ' . (string)(count($css) + count($js)) . ' files' . PHP_EOL;
echo '=========== Successful ===========' . PHP_EOL;
