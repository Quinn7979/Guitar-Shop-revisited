<?php
//Create database connection
$host = 'localhost';
//$host = 'localhost';
$dbname = 'my_guitar_shop1';
//$dbname = 'crystalw_my_guitar_shop1';
$username = 'mgs_user';
//$username = 'crystalw_mgs_user';
 $password = 'pa55word';
//$password = 'ilovemydogcallie#79';

// Create the connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    // Redirect to the error page if the connection fails
    header('Location: database_error.php');
    exit();
}

?>