<?php
// session_start();
include_once "config.php";
if (isset($_POST['selectedSeat'])){
    echo "<script>alert($_POST[selectedSeat]);</script>";
    $sql="update user_form set area='$_POST[selectedSeat]' where id=$_SESSION[id]";
    mysqli_query($conn, $sql);
    $sql2="INSERT INTO riwayat_parkir(plat, area) VALUES('$_SESSION[plat]','$_POST[selectedSeat]')";
    mysqli_query($conn, $sql2);
}

if (isset($_POST['unselectedSeat'])){
    echo "<script>alert($_POST[unselectedSeat]);</script>";
    $sql="update user_form set area=null where id=$_POST[unselectedSeat]";
    mysqli_query($conn, $sql);
}
$sql="select * from user_form";
$result=mysqli_query($conn, $sql);
// $data=mysqli_fetch_assoc($result);

$pengguna=array();
$user="";

while ($row = mysqli_fetch_assoc($result)){
    if($row['id'] == $_SESSION['id']) {
        $user = $row['area'];
    }
    if(!empty($row['area'])){
        array_push($pengguna, $row['area']);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Peta Lokasi Parkir</title>
    <style>
        #seat-map {
            display: flex;
            flex-wrap: wrap;
            max-width: 500px;
            
        }
        .seat {
            width: 50px;
            height: 50px;
            border: 1px solid #ccc;
            margin: 5px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
        }
        .occupied {
            cursor: not-allowed;
        }
        .selected {
            background-color: #44576d;
            color: white;
        }
        .self {
            background-color: green;
        }
    </style>
</head>
<body>
    <h1>Peta Lokasi Parkir</h1>
    <div id="seat-map">
        <!-- Tempat duduk akan ditambahkan secara dinamis menggunakan JavaScript -->
    </div>
    <h2>Tempat Parkir Terpilih: <span id="selected-seat"></span></h2>
    
    <form method="POST" action="">
        <input type="hidden" id="selectedSeatInput" name="selectedSeat">
        <input type="submit" value="Simpan Tempat Duduk">
    </form>

    <script>
        // Ukuran peta lokasi duduk
        var rows = 10;
        var cols = 10;

        <?php
        $js_array = json_encode($pengguna);
        echo "var pengguna = ". $js_array . ";\n";
        if($user) {
            echo "var user = ". $user . ";\n";    
        } else {
            echo "var user = ''";
        }
        
        ?>

        // Daftar status duduk (tersedia atau terisi)
        var seatStatus = Array(rows * cols).fill('available');

        // Mengambil elemen div untuk tempat duduk
        var seatMap = document.getElementById('seat-map');
        // Mengambil elemen span untuk tempat duduk terpilih
        var selectedSeat = document.getElementById('selected-seat');

        var selectedSeatIndex = -1; // Menyimpan index tempat duduk terpilih

        // Menambahkan tempat duduk ke dalam elemen div
        for (var i = 0; i < seatStatus.length; i++) {
            var seat = document.createElement('button');
            seat.className = 'seat';

            if (pengguna.find(x => x-1 == i)){
                seat.classList.add('selected');
                seat.setAttribute("disabled", true)
                seat.classList.add('occupied');
            } 

            if(i == user-1) {
                seat.classList.add('self');
                seat.setAttribute("disabled", true)
            } 
            if(user) {
                seat.setAttribute("disabled", true)
                seat.classList.add('occupied'); 
            }
            
            // Mengatur kelas CSS berdasarkan status duduk
            
            seat.innerText = i + 1; // Menampilkan nomor tempat duduk
            seat.addEventListener('click', function() {
                // Mengubah status duduk saat tempat duduk diklik
                var seatIndex = Array.from(seatMap.children).indexOf(this);
                if (seatStatus[seatIndex] === 'available') {
                    // Membatalkan pemilihan tempat duduk sebelumnya
                    if (selectedSeatIndex !== -1) {
                        seatStatus[selectedSeatIndex] = 'available';
                        seatMap.children[selectedSeatIndex].classList.remove('selected');
                    }
                    seatStatus[seatIndex] = 'selected';
                    this.classList.add('selected');
                    selectedSeatIndex = seatIndex;
                    selectedSeat.innerText = seatIndex + 1;
                    document.getElementById('selectedSeatInput').value=seatIndex + 1;
                } else if (seatStatus[seatIndex] === 'selected') {
                    seatStatus[seatIndex] = 'available';
                    this.classList.remove('selected');
                    selectedSeatIndex = -1;
                    selectedSeat.innerText = '';
                }
            });
            
            seatMap.appendChild(seat);
        }
    </script>
</body>
</html>