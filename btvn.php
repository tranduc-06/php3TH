<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="phone">Phone</label>
      <div class="col-sm-10 m-b">
        <input type="text" class="form-control" name="phone" id="phone">
      </div>
    </div>
    <div class="form-group">
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

  include('config.php');

  if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    $sql = "INSERT INTO persons (name, phone, email,address)
        VALUES ('$name', '$phone', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  $sql_lietke = "SELECT * FROM persons";
  $row_lietke = mysqli_query($conn, $sql_lietke);


  ?>
  <form action="" method="GET">

    <div class="input-group rounded">
      <input type="search" name="keyword" class="form-control col-sm-2 rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
      <button type="submit" name="search">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </form>
  
  <?php
    if (isset($_GET['search'])) {
      $keyword = $_GET['keyword'];
      $sql_search = "SELECT * FROM persons WHERE name LIKE '%$keyword%'
          OR address LIKE '%$keyword%' 
          OR email LIKE '%$keyword%' ";
      $row_search = mysqli_query($conn, $sql_search);
  }
    if(isset($_GET['order'])) {
      $column = $_GET['column'];
      $order = $_GET['order'];
      $sort = mysqli_query($conn,"SELECT * FROM persons ORDER BY ".$column." ".$order." ");
    }
  ?>


  <br>

  <table class="table">
    <tr>
      <th>ID</th>
      <th>Name<a href="?column=name&order=ASC">ASC</a>|<a href="?column=name&order=DESC">DESC</a></th>
      <th>Phone</th>
      <th>Email</th>
      <th>Address</th>
      <th>Action</th>
    </tr>

    <?php
    if (isset($row_search)) {
      $i = 0;
      while ($value = mysqli_fetch_array($row_search)) {
    ?>
        <tr>
          <td><?php echo $value['id'] ?></td>
          <td><?php echo $value['name'] ?></td>
          <td><?php echo $value['phone'] ?></td>
          <td><?php echo $value['email'] ?></td>
          <td><?php echo $value['address'] ?></td>
          <td><a href="delete.php?id=<?php echo $row['id'] ?>">Delete</a></td>
        </tr>
    <?php
      }
    ?>

<?php
    } else if (isset($sort)) {
      $i = 0;
      while ($value = mysqli_fetch_array($sort)) {
    ?>
        <tr>
          <td><?php echo $value['id'] ?></td>
          <td><?php echo $value['name'] ?></td>
          <td><?php echo $value['phone'] ?></td>
          <td><?php echo $value['email'] ?></td>
          <td><?php echo $value['address'] ?></td>
          <td><a href="delete.php?id=<?php echo $row['id'] ?>">Delete</a></td>
        </tr>
    <?php
      }
    ?>

    <?php
    } else{
      
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4 ;
    $current_page = !empty($_GET['page'])?$_GET['page']:1;
    $offset = ($current_page-1) * $item_per_page;
    $user = mysqli_query($conn,"SELECT * FROM persons ORDER BY id ASC LIMIT ".$item_per_page." OFFSET ".$offset." ");
    $total_record = mysqli_query($conn,"SELECT * FROM persons")->num_rows;
    $total_page = ceil($total_record/ $item_per_page);

    $i = 0;
    while ($row = mysqli_fetch_array($user)) {
      $i++;
    ?>
      <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['phone'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['address'] ?></td>
        <td><a href="delete.php?id=<?php echo $row['id'] ?>">Delete</a></td>
      </tr>
    <?php
    }}
    ?>
  </table>   
    <?php
      include('paginate.php');
    ?>
</body>

</html>