<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use MatthiasMullie\Minify;

// function minify($source, $destination, $type)
// {
//   if ($type == "CSS")
//     $minifier = new Minify\CSS($source);
//   else 
//     $minifier = new Minify\JS($source);
  
//   return $minifier->minify($destination);
// }
$css = array_slice(scandir($_SERVER['DOCUMENT_ROOT'] . '/assets/css/'), 2);
$js = array_slice(scandir($_SERVER['DOCUMENT_ROOT'] . '/assets/js/'), 2);
# Define path for js/css files
foreach ($css as $i) {
  if (explode('.', $i)[1] == 'js')
  if (explode('.', $i)[1] == 'css')
}
$source_js = '/path/to/source/css/file.css';
$source_css = '/path/to/minified/css/file.css';
$destination_js =
$destination_css = 

