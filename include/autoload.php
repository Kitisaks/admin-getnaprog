<?php
spl_autoload_register(function($className) {
	$file = $_SERVER['DOCUMENT_ROOT'] . '/' . strtolower($className) . '.php';
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

  if (file_exists($file)) {
		require_once $file;
	}
});
