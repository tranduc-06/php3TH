<?php
    include('config.php');

        $id = $_GET['id'];
        $sql_delete = " DELETE FROM persons where id = '".$id."' ";
        mysqli_query($conn,$sql_delete);
        header('Location:btvn.php');
?>