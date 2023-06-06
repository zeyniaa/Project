<?php
session_start();
unset($_SESSION['Username']);
session_destroy();
echo"<script>alert('Anda Berhasil Keluar');window.location.href='login_form.php';</script>";
mysqli_close($conn);
?>