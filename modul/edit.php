<div class="container p-5">

<h4>Edit Data Detail</h4>
<?php
    include_once "../config.php";
	$ID=$_POST['record'];
	$qry=mysqli_query($conn, "SELECT * FROM riwayat_parkir Where `area`='$ID'");
	$numberOfRow=mysqli_num_rows($qry);
	if($numberOfRow>0){
		while($row1=mysqli_fetch_array($qry)){
      $pID=$row1["id"];
?>
<form id="update-Items" onsubmit="updateVariations()" enctype='multipart/form-data'>
    <div class="form-group">
        <input type="text" class="form-control" id="id" value="<?=$row1['id']?>" hidden>
        </div>
	
    <div class="form-group">
        <label>Plat :</label>
        <select id="plat" >
        <?php

        $sql="SELECT * from riwayat_parkir where id=$pID";
        $result = $conn-> query($sql);

        if ($result-> num_rows > 0){
        while($row = $result-> fetch_assoc()){
            echo"<option selected value='".$row['id']."'>".$row['plat'] ."</option>";
        }
        }
        ?>
        <?php

            $sql="SELECT * from riwayat_parkir where id!=$pID";
            $result = $conn-> query($sql);

            if ($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()){
                echo"<option value='".$row['id']."'>".$row['plat'] ."</option>";
            }
            }
        ?>
        </select>
    </div>
   
    <div class="form-group">
        <label for="area">Change Area :</label>
        <input type="number" class="form-control" id="area" value="<?=$row1['area']?>"  required>
    </div>
    <div class="form-group">
      <button type="submit" style="height:40px" class="btn btn-primary">Update Variation</button>
    </div>
    <?php
    		}
    	}
    ?>
  </form>

  
</div>