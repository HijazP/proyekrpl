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
  

        </div>

        <div class="signup">
            <h1>Create an account</h1>
            <form action="" method="POST" class="box">
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