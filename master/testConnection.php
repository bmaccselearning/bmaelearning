<?php

//$mysqli_connection = new MySQLi('10.255.2.84', 'bangkok', 'ioh[tn09s0v]1S[M', 'bangkok_moodle');
$mysqli_connection = new MySQLi('127.0.0.1', 'root', '', 'moodle');

if ($mysqli_connection->connect_error) {
   echo "Not connected, error: " . $mysqli_connection->connect_error;
}
else {
   echo "Connected.";
}
?>