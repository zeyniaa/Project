<?php
include_once "config.php";
session_start();
$nama  = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/
        all.min.css">

        <link rel="stylesheet" href="css/style1.css">


    </head>


    <body>

        <header>

            <div class="user">
                <img src="images/pic.jpg" alt="">
                <h3 class="name">Halo, <?php echo $nama ?>!</h3>
                <p class="post">front end developer</p>
            </div>

            <nav class="navbar">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#lokasi">Lokasi Parkir</a></li>
                    <li><a href="#history">History</a></li>
                    <li><a href="logout_form.php">Exit</a></li>
                </ul>
            </nav>
        </header>
    </body>

    <!-- header section ends -->

    <div id="menu" class="fas fa-bars"></div>

    <!-- home section starts -->
    <section class="home" id="home">
        <h3>HI THERE !<h3>
        <h1>Selamat Datang</h1>
    </section>
    <!-- home section starts --> 

    <!-- about section starts --> 
    <section class="lokasi" id="lokasi">
        <?php
        if (isset($_GET["page"])) {
            include "konten/$_GET[page].php";
        } else {
            include_once "konten/denah.php";
        }
        ?>
    </section>


    <!-- jquery cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="script.js"></script>
</html>