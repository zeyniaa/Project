<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>login form</title>

    <style>
        body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        padding: 20px;
        }
        
        h2 {
            margin-bottom: 20px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td {
            padding: 10px;
            text-align: center;
        }
        
        .table th {
            background-color: #f0f0f0;
        }
        
        .btn {
            padding: 5px 15px;
            border-radius: 3px;
            font-size: 14px;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        
        .btn-danger:hover {
            background-color: #b02a37;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
            max-width: 500px;
        }
        
        .modal-header h4 {
            margin-top: 0;
        }
        
        .close {
            color: #888;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

    </style>

</head>

<body>
      
    <div>
        <h2>History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Plat</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Date</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>
            </thead>
            <?php
            include_once "../config.php";
            $sql="SELECT * FROM user_db.riwayat_parkir";
            $result=$conn-> query($sql);
            $count=1;
            if ($result-> num_rows > 0){
                while ($row=$result-> fetch_assoc()) {
            ?>
            <tr>
            <td><?=$count?></td>
            <td><?=$row["plat"]?></td>      
            <td><?=$row["area"]?></td>     
            <td><?=$row["date"]?></td>     
            <td><button class="btn btn-primary" style="height:40px" onclick="edit('<?=$row['variation_id']?>')"><a href="../modul/edit.php">Edit</a></button></td>
            <td><button class="btn btn-danger" style="height:40px" onclick="edit('<?=$row['variation_id']?>')"><a href="../modul/exit.php">Exit</a></button></td>
            <td><button class="btn btn-danger" style="height:40px" onclick="edit('<?=$row['variation_id']?>')"><a href="../modul/delete.php">Delete</a></button></td>
            </tr>
            <?php
                    $count=$count+1;
                }
                }
            ?>
        </table>

        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal"><a href="../admin_page.php">Home</a></button>
    </div>
</body>
</html>