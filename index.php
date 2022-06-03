<?php
    require_once("config2.php");

    if (isset($_POST['register'])) {
        //Masukin inputan dari html ke variabel-variabel berikut
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $confirm_password = password_hash($_POST["confirm_password"], PASSWORD_DEFAULT);
        $avatar = "images/chad.jpg";

        //Query buat cek username atau password udah ada
        $sql = "SELECT * FROM user WHERE username=:username OR email=:email";
        $stmt = $db->prepare($sql);

        //Param
        $params = array(
            "username" => $username,
            ":email" => $email
        );

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //Ngecek kalo misal inputannya ada yang kosong
        if (empty($username) || empty($email) || empty($_POST["password"]) || empty($_POST["confirm_password"])) {
            //Ngeluarin pesan perlu diisi semua
            echo '<script>alert("Please fill all required fields!")</script>';
            return false;
            //die('Please fill all required fields!');
        }

        //Ngecek kalo misal username atau email udah ada
        if ($user) {
            die('Username or Email already exists!');
        }

        //Kalo semua penuh, siapin dulu query buat create atau insert
        $sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $db->prepare($sql);
        $copy = "INSERT INTO profile (username, email, password, avatar) VALUE (:username, :email, :password, :avatar)";
        $stmt_copy = $db->prepare($copy);

        //bikin array buat masukin variabel ke atribut tabel
        $params = array(
            ":username" => $username,
            ":email" => $email,
            ":password" => $password,
        );
        $params_copy = array(
            ":username" => $username,
            ":email" => $email,
            ":password" => $password,
            ":avatar" => $avatar
        );

        //Ngecek kalo misal password sama confirm password nilainya sama
        if ($_POST["password"] === $_POST["confirm_password"]) {
            //Nyimpen persiapan query tadi ke parameter atau atribut tabel
            $save = $stmt->execute($params);
            $stmt_copy->execute($params_copy);
            if ($save) {
                //Kalo misal berhasil disimpen, balik ke index.php
                header("Location: index.php");
            }
        }
        else
        {
            die('Passwords do not match!');
        }
    }

    if (isset($_POST['login'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $sql = "SELECT * FROM profile WHERE email=:email";
        $stmt = $db->prepare($sql);

        $params = array(
            ":email" => $email
        );

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user["password"])) {
                session_start();
                $_SESSION["user"] = $user;
                header("Location: dashboard/dashboard.php");
            }
            else
            {
                die('Wrong password!');
            }
        }
        else
        {
            die('Wrong email!');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect.gg</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <div class="container">
        
        <input type="checkbox" id="toggle">
        <div class="signin">
            <h1>Sign In</h1>
            <form action="" method="POST" class="box">
                <input type="email" placeholder="Email" class="email" name="email">
                <input type="password" placeholder="Password" class="password" name="password">
                <small> <label for="toggle2">Forgot Password?</label></small>
                <input a href = "dashboard.php" type="submit" value="Login" class="submit" name="login">
                <small>Don't have an account? <label for="toggle">Sign Up</label> </small>
           
            </form>

        </div>
                <div class="signup">
            <h1>Create an account</h1>
            <form action="" method="POST" class="box">
                    <input type="text" placeholder= "Name" class="name" name="name">
                    <input type="text" placeholder="Username" class="username" name="username">
                    <input type="email" placeholder="Email" class="email" name="email">
                    <input type="password" placeholder="Password" class="password" name="password">
                    <input type="password" placeholder="Confirm Password" class="confirm_password" name="confirm_password">
                <input a href = "index.php" type="submit" value="Create Account" class="submit" name="register">
                <small>Already have an account? <label for="toggle">Sign In</label></small>
            </form>
        </div>

        <div class="recover">
            <h1>Enter your email</h1>
            <form action="" method="POST" class="box">
                    <input type="email" placeholder="Email" class="email" name="email">
                    <input type="submit" value="Recover Password">
                <small>Already have an account? <label for="toggle">Sign In</label></small>
            </form>
        </div>

    </div>
</body>
</html>