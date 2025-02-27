<?php
  ob_start(); // turn on output buffering

  // session_start(); // turn on sessions if needed

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value:
  // define("WWW_ROOT", '/~kevinskoglund/chain_gang/public');
  // define("WWW_ROOT", '');
  // * Can dynamically find everything in URL up to "/public"
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);

  require_once('functions.php');
  require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');
  require_once('vendor/autoload.php');

  $conn = db_connect(); 

  // Load class definitions manually

  // -> Individually
  // require_once('classes/bicycle.class.php');

  // -> All classes in directory
 

  // Autoload class definitions
  function my_autoload($class) {
    // Modify the path to append the .class.php extension
    $file = PRIVATE_PATH . '/' . $class . '.class.php';  // Change from .php to .class.php
    if (file_exists($file)) {
        require_once($file);
    } else {
        die("Autoload error: Class file for {$class} not found at {$file}");
    }
}
spl_autoload_register('my_autoload');

  $database = db_connect();
  DatabaseObject::set_database($database);

  $session = new Session;

  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;
  $logger = new Logger("guitar-store");
  $file_stream_handler = new StreamHandler("guitar_store.log");
  $logger->pushHandler($file_stream_handler);
?>
