<?php

    include_once "../config.php";
    
    $id=$_POST['record'];
    $query="DELETE FROM user_form where id='$id'";

    $data=mysqli_query($conn,$query);

    if($data){
        echo"user Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>