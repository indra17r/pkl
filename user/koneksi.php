<?php
session_start();
$situs="http://localhost/pkl/";
$con=mysqli_connect("localhost","root","","pkl");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// ...some PHP code for database "my_db"...

// Change database to "test"
mysqli_select_db($con,"test");

// ...some PHP code for database "test"...

mysqli_close($con);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pkl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>