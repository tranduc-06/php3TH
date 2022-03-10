<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

// $sql = "INSERT INTO persons (last_name, first_name, age, address)
// VALUES ('John', 'Doe', '18','Ha Noi')";

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();

$sql = "SELECT id, first_name, last_name FROM persons";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>

