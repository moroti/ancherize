<?php
require "inc/Classes.php";
require "inc/an-db.php";
// Require composer autoloader
require "vendor/autoload.php";
require "inc/dotenv-loader.php"
?>
<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$driver = $url["scheme"];
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

if(!isset($url["port"])){
  $dsn = "${driver}:host=${server};dbname=${db}";
}else{
  $dsn = "${driver}:host=${server};port={$url['port']};dbname=${db}";
}

$anch = new Ancherize_DB('ancherize$khaled@paul', $dsn, $username, $password);
?>