<?php

ob_start();

// -----

// Error displaying (comment the following to turn on error displaying)

error_reporting(E_ALL);

// Constants

define('ROOT_DIR', dirname(__FILE__));

// Imports

require_once 'lib/magic_quotes_fix.php';
require_once 'lib/autoload.php';

// Run the application

$application = new Application();
$application->config();

$response = $application->run(new Request());
$response->send();

// -----

ob_end_flush();

?>
