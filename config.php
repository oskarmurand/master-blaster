<?php
ini_set("display_errors", true);
date_default_timezone_set("Europe/Copenhagen");  // http://www.php.net/manual/en/timezones.php
define("DB_DSN", "mysql:host=mysql.planet.ee;dbname=erikweb");
define("DB_USERNAME", "erikweb");
define("DB_PASSWORD", "fepproject123");
define("CLASS_PATH", "classes");
define("TEMPLATE_PATH", "templates");
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "admin");
 
function handleException($exception) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log($exception->getMessage());
}
 
set_exception_handler('handleException');
?>