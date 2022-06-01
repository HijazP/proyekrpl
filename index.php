<?php
    require_once("config2.php");

    if (isset($_POST['register'])) {
        //Masukin inputan dari html ke variabel-variabel berikut
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $confirm_password = password_hash($_POST["confirm_password"], PASSWORD_DEFAULT);

        //Ngecek kalo misal inputannya ada yang kosong
        if (empty($username) || empty($email) || empty($_POST["password"]) || empty($_POST["confirm_password"])) {
            //Ngeluarin pesan perlu diisi semua
            die('Please fill all required fields!');
        }

        //Kalo semua penuh, siapin dulu query buat create atau insert
        $sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $db->prepare($sql);
        $copy = "INSERT INTO profile (username, email, password) VALUE (:username, :email, :password)";
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
        );

        //Ngecek kalo misal password sama confirm password nilainya sama
        if ($_POST["password"] === $_POST["confirm_password"]) {
            //Nyimpen persiapan query tadi ke parameter atau atribut tabel
            $save = $stmt->execute($params);
            $save_copy = $stmt_copy->execute($params_copy);
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In & Sign Up</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">

        <input type="checkbox" id="toggle">
        <div class="signin">
            <h1>Sign In</h1>
            <form>
            
                
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <small> <label for="toggle2">Forgot Password?</label></small>
                <input type="submit" value="Login">
                <small>Don't have an account? <label for="toggle">Sign Up</label> </small>
           
            </form>

        </div>

        <div class="signup">
            <h1>Create an account</h1>
            <form action="" method="POST" class="box">
              
                    <input type="text" placeholder="Username" class="username" name="username">
                    <input type="email" placeholder="Email" class="email" name="email">
                    <input type="password" placeholder="Password" class="password" name="password">
                    <input type="password" placeholder="Confirm Password" class="confirm_password" name="confirm_password">
                <input type="submit" value="Create Account" class="submit" name="register">
                <small>Already have an account? <label for="toggle">Sign In</label></small>
            </form>
        </div>

        <div class="recover">
            <h1>Enter your email</h1>
            <form>
              
                
                    <input type="email" placeholder="Email">

                <input type="submit" value="Recover Password">
                <small>Already have an account? <label for="toggle">Sign In</label></small>
            </form>
        </div>

    </div>
</body>
</html>