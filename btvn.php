<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
  <div class="form-group">
    <label class="col-sm-2 control-label" for="name">Name:</label>
    <div class="col-sm-10 m-b">
    <input type="text" class="form-control" name="name" id="name">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="email">Email:</label>
    <div class="col-sm-10 m-b">
    <input type="email" class="form-control" name="email" id="email">
    </div>
  </div>  <div class="form-group">
    <label class="col-sm-2 control-label" for="phone">Phone</label>
    <div class="col-sm-10 m-b">
    <input type="text" class="form-control" name="phone" id="phone">
    </div>
  </div>  <div class="form-group">
    <label class="col-sm-2 control-label" for="address">Address:</label>
    <div class="col-sm-10 m-b">
    <input type="text" class="form-control" name="address" id="address">
    </div>
  </div>

  <div class="form-group"> 
      <button type="submit" name="submit" class="btn btn-primary ">Submit</button>
  </div>
</form>

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
    
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if (isset($_POST['submit']))
{
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
}

    
    
        $sql = "INSERT INTO persons (name, phone, email,address)
        VALUES ('$name', '$phone', '$email', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $sql_lietke = "SELECT * FROM persons";
        $row_lietke = mysqli_query($conn,$sql_lietke);
  
    
?>

<table class="table">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Address</th>
  </tr>
  <?php
        $i=0;
        while($row=mysqli_fetch_array($row_lietke)){
            $i++;
    ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['name'] ?></td>
    <td><?php echo $row['phone'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td><?php echo $row['address'] ?></td>
    
  </tr>
  <?php
    }
  ?>
</table>
</body>
</html>