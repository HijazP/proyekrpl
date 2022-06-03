<?php
    //Melepaskan sesi kemudian memindahkan user ke halaman index.php
    session_start();
    session_unset();
    header("Location: ../index.php");