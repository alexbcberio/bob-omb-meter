<?php
chdir("..");

function endsWith( $haystack, $needle ) {
  $length = strlen( $needle );
  if( !$length ) {
      return true;
  }
  return substr( $haystack, -$length ) === $needle;
}

$uri = $_SERVER["REQUEST_URI"];

if (endsWith($uri, "/")) {
  $uri .= "index.php";
}

$uri = realpath(__DIR__ ."/.." . $uri);

if (!file_exists($uri)) {
  header("Status: 404 Not Found");

} else {
  require($uri);
}