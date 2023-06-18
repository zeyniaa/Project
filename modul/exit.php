<?php

    include_once "../config.php";
    
    $id=$_POST['record'];
    $query="DELETE FROM riawat_parkir where area='$id'";

    $data=mysqli_query($conn,$query);

    if($data){
        echo"Area Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>