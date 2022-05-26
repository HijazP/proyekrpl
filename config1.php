<?php
    // variabel database
    $servername = "localhost";
    $database = "web_rpl";
    $username = "root";
    $password = "";

    // koneksi ke database menggunakan mysqli
    $conn = mysqli_connect($servername, $username, $password, $database);