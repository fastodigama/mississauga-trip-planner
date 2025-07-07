<?php
// Attempt to connect to the MySQL database using mysqli_connect()
// Parameters: hostname, username, password, database name
$connect = mysqli_connect('localhost','root','root','miway_general_transit');

// Check if the connection was unsuccessful
if(!$connect){
     // If connection fails, stop the script and display an error message
    die("Connection Failed" . mysqli_connect_error());
}
// If connection is successful, the script will continue silently
?>