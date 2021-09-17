<?php
require_once '../../vendor/autoload.php';
use MatthiasMullie\Minify;

$dir = '../../assets';

function get_file(string $type)
{
  global $dir;
  $file = array_filter(
    array_slice(scandir($dir . "/{$type}/*"), 2),
    fn ($n) => strpos(".{$type}", $n) !== true
  );
  return array_map(
    fn ($n) => $dir . '/' . $n,
    $file
  );
}

echo '<h2>=========== Deploy assets ===========</h2>';
$js = get_file('js');
$css = get_file('css');

# Minify for css files
for ($i=0;$i<=count($css);$i++) {
  if ($i == 0) {
    echo $css[$i];
    $minifier_css = new Minify\CSS($css[$i]);
  } else {
    $minifier_css->add($css[$i]);
  }
}
# Minify for js files
for ($i=0;$i<=count($js);$i++) {
  if ($i == 0) {
    $minifier_js = new Minify\JS($js[$i]);
  } else {
    $minifier_js->add($js[$i]);
  }
}

# Delete old files
foreach (glob(__DIR__ . '/css/*') as $old) {
  if (is_file($old)) {
    echo '<p><span style="color:red">deleted old .css</span> => ' . $old . '</p>';
    unlink($old);
  }
    
}
foreach (glob(__DIR__ . '/js/*') as $old) {
  if (is_file($old)) {
    echo '<p><span style="color:red">deleted old .js</span> => ' . $old . '</p>';
    unlink($old);
  }
}

$f_css = __DIR__ . '/css' . '/css_' . uniqid() . '.css';
$f_js = __DIR__ . '/js' . '/js_' . uniqid() . '.js';

echo $minifier_css->minify();

$minifier_css->minify($f_css);
$minifier_js->minify($f_js);

echo '<p style="color:green">digested => ' . (string)(count($css) + count($js)) .' files</p>';
echo '<h2>=========== Successful ===========</h2>';
