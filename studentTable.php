 <?php
$servername = "192.168.101.6";
$username = "tejaswee";
$password = "centos";
$dbname = "studentDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE studentDetails (
rno INT(6) PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
gender VARCHAR(15)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table studentDetails created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 
