<?php

try {
$db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=tth_php_database', 'root', '');
  //$db = new PDO("sqlite:".__DIR__."/database.db");
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo "Unable to connect";
  echo $e->getMessage();
  exit;
}

// // prints e.g. 'Current PHP version: 4.1.1'
// //echo 'Current PHP version: ' . phpversion();

// $db = new mysqli("127.0.0.1", "root", "", "tth_php_database", 3306);
// if ($db->connect_errno) {
//     echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
// }

// //echo $db->host_info . "\n";
