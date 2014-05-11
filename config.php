<?php
ini_set("display_errors", true);
date_default_timezone_set("Europe/Copenhagen");  // http://www.php.net/manual/en/timezones.php
define("DB_DSN", "mysql:host=mysql.planet.ee;dbname=erikweb");
define("DB_USERNAME", "erikweb");
define("DB_PASSWORD", "fepproject123");
define("TEMPLATE_PATH", "templates");
define("CLASS_PATH", "classes");
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "admin");
define("QUERY_STRING", '?'.$_SERVER['QUERY_STRING']);
define("BASE_URL", $_SERVER['SERVER_NAME'].'/fep');
define("FULL_URL", BASE_URL.QUERY_STRING);
require_once(CLASS_PATH . "/user.php");
?>