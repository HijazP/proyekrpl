<?php
    session_start();

    if (!isset($_SESSION["user"])) {
        header("Location: index.php");
    }

    if (isset($_POST["update_general"])) {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $birth_date = $_POST["birth_date"];
        $sex = filter_input(INPUT_POST, "sex", FILTER_SANITIZE_STRING);
        $region = filter_input(INPUT_POST, "region", FILTER_SANITIZE_STRING);

        if (empty($name) || empty($username)) {
            die("Name or Username must be filled!");
        }

        $sql = "UPDATE profile SET username=:username, status=:status, name=:name, birth_date=:birth_date, sex=:sex, region=:region WHERE username=:username";
        $stmt = $db->prepare($sql);

        $param = array(
            ":name" => $username,
            ":status" => $status,
            ":username" => $username,
            ":birth_date" => $birth_date,
            ":sex" => $sex,
            ":region" => $region
        );


    }

    if (isset($_POST["update_account_details"])) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect.gg</title>
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="./dashboard.css">
</head>
<body>

    <!------------------------- MAIN -------------------------->
    <main>
        <div class="container">
            <!--======================== LEFT ==========================-->
            <div class="left">
                
                <div class="logo">
                    <img src="./images/connect.png">
                </div>

                <!-- close button -->
                <span id="close-btn"><i class="uil uil-multiply"></i></span>

                <!-------------------- SIDEBAR ------------------------->
                <div class="sidebar">
                    <a href="dashboard.php" class="menu-item active">
                        <span><i class="uil uil-home"></i></span><h3>Home</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-search"></i></span><h3>Service</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-heart"></i></span><h3>Friends</h3>
                    </a>
                    <a class="menu-item" id="notifications">
                        <span><i class="uil uil-bell"><small class="notification-count">9+</small></i></span><h3>Notifications</h3>
                        <!-------------------- NOTIFICATION POPUP ---------------->
                        <div class="notifications-popup">
                            <div>
                                <div class="profile-photo">
                                    <img src="./images/chad.jpg">
                                </div>
                                <div class="notification-body">
                                    <b>User_1</b> accepted your friend request
                                    <small class="text-muted">2 DAYS AGO</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./images/chad.jpg">
                                </div>
                                <div class="notification-body">
                                    <b>User_2</b> commented on your post
                                    <small class="text-muted">1 HOUR AGO</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./images/chad.jpg">
                                </div>
                                <div class="notification-body">
                                    <b>User_3</b> and <b>283 others </b> liked your post
                                    <small class="text-muted">4 MINUTES AGO</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./images/chad.jpg">
                                </div>
                                <div class="notification-body">
                                    <b>User_4</b> commented on a post you are tagged in
                                    <small class="text-muted">2 DAYS AGO</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./images/chad.jpg">
                                </div>
                                <div class="notification-body">
                                    <b>User_5</b> commented on a post you are tagged in
                                    <small class="text-muted">1 HOUR AGO</small>
                                </div>
                            </div>
                            <div>
                                <div class="profile-photo">
                                    <img src="./images/chad.jpg">
                                </div>
                                <div class="notification-body">
                                    <b>User_6</b> commented on your post
                                    <small class="text-muted">1 HOUR AGO</small>
                                </div>
                            </div>
                        </div>
                        <!-------------------- END NOTIFICATION POPUP ---------------->
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-bookmark"></i></span><h3>Wallet</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-setting"></i></span><h3>Settings</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-setting"></i></span><h3>Logout</h3>
                    </a>                        
                </div>
                <!------------------- END OF SIDEBAR -------------------->
                <a href="userprofile.php" class="profile">
                    <div class="profile-photo">
                        <img src="<?php echo $_SESSION["user"]["avatar"] ?>">
                    </div>
                    <div class="handle">
                        <h4>
                            <?php echo $_SESSION["user"]["username"]?>
                        </h4>
                        <p class="text-muted">
                            <?php echo $_SESSION["user"]["email"] ?>
                        </p>
                    </div>
                </a>
                </div>
            <!------------------- END OF LEFT -------------------->

            <!--======================== MIDDLE ==========================-->
            <div class="middle">

                <form class="search">
                    <i class="uil uil-search"></i>
                    <input type="search" placeholder="Search..." id="search">  
                </form>

                <!------------------- FEEDS --------------------->
                    <!------------------- FEED 1 --------------------->
                    <div class="feeds">  
                        <div class = "feed">
                            <!-- Foto -->
                            <div class="bg">
                                <div class="bg_item">
                                    <img src="./images/propil.jpg">
                                </div>
                                <div class="bg_item">
                                    <img src="<?php echo $_SESSION["user"]["avatar"] ?>">
                                </div>
                            </div>

                            <div class="marginedit">
                            <h2>Images</h2>
                            </div>
                            <div class="request1">

                                <h3> Background Image  </h3>
                                    <div class = "requestedit">
                                    <input type="file">
                                </div>

                                <h3> Profile Image  </h3>
                                    <div class = "requestedit">
                                    <input type="file">
                                </div>

                                <div class="actionedit">
                                    <a class="btn btn-primary"><h3>Apply</h3></a>
                                </div>   
 
                            </div>

                            <div class="marginedit">
                            <h2>General</h2>
                            </div>
                            <div class="request1">

                                <h3> Name  </h3>
                                <div class = "requestedit">
                                    <input type="text" placeholder="Name" class="name" name="name" value="<?php echo $_SESSION["user"]["first_name"] ?>">
                                </div>

                                <h3> Status </h3>
                                <div class = "requestedit">
                                    <input type="text" placeholder="Status" class="status" name="status" value="<?php echo $_SESSION["user"]["status"] ?>">
                                </div>

                                <h3> Username </h3>
                                <div class = "requestedit">
                                    <h5><?php echo $_SESSION["user"]["username"] ?></h5>
                                </div>

                                <h3> Birth Date </h3>
                                <div class = "requestedit">
                                    <input type="date" placeholder="birthdate" class="birthdate" name="birthdate" value="<?php echo $_SESSION["user"]["birth_date"] ?>">
                                </div>

                                <h3> Sex </h3>
                                <div class = "requestedit">
                                    <input type="text" placeholder="Sex" class="sex" name="sex" value="<?php echo $_SESSION["user"]["sex"] ?>">
                                </div>

                                <h3> Region </h3>
                                <div class = "requestedit">
                                    <input type="text" placeholder="Region" class="region" name="region" value="<?php echo $_SESSION["user"]["region"] ?>">
                                </div>

                                <div class="actionedit">
                                    <a class="btn btn-primary"><h3>Apply</h3></a>
                                </div>   
                            </div>

                            <div class="marginedit">
                            <h2>Preference</h2>
                            </div>
                            <div class="request1">

                                <h3> Preferred Games </h3>
                                <div class = "requestedit">

                                </div>

                                <h3> Preferred Languages </h3>
                                <div class = "requestedit">
    
                                </div>

                                <div class="actionedit">
                                    <a class="btn btn-primary"><h3>Apply</h3></a>
                                </div>   
 
                            </div>

                            <div class="marginedit">
                            <h2>Account Details</h2>
                            </div>
                            <div class="request1">

                                <h3> Password </h3>
                                <div class = "requestedit">
                                    <input type="password" placeholder="Password" class="password" name="password">
                                </div>

                                <h3> Email </h3>
                                <div class = "requestedit">
                                    <input type="email" placeholder="Email" class="email" name="email" value="<?php echo $_SESSION["user"]["email"] ?>">
                                </div>

                                <div class="actionedit">
                                    <a class="btn btn-primary"><h3>Apply</h3></a>
                                </div>   
 
                            </div>


                        </div>
                    </div>
                    <!---------------- END OF FEED 1 ----------------->
                <!------------------------------- END OF FEEDS ------------------------------------>
            </div>
            <!--======================== END OF MIDDLE ==========================-->


            <!--======================== RIGHT ==========================-->
            <div class="right">
                <div class="messages">
                    <div class="heading">
                        <h4>Messages</h4><i class="uil uil-edit"></i>
                    </div>
                    <!------------ SEARCH BAR -------------->
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" placeholder="Search messages" id="message-search">
                    </div>
                    <!------------ MESSAGES CATEGORY -------------->
                    <div class="category">
                        <h6 class="active">Primary</h6>
                        <h6 class="message-requests">Requests(7)</h6>
                    </div>
                    <!------------ MESSAGE -------------->
                    <!----- MESSAGE ----->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./images/chad.jpg">
                        </div>
                        <div class="message-body">
                            <h5>User_1</h5>
                            <p class="text-muted">Cuk mabar</p>
                        </div>
                    </div>
                    <!----- MESSAGE ----->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./images/chad.jpg">
                            <div class="active"></div>
                        </div>
                        <div class="message-body">
                            <h5>User_2</h5>
                            <p class="text-bold">woi</p>
                        </div>
                    </div>
                    <!----- MESSAGE ----->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./images/chad.jpg">
                        </div>
                        <div class="message-body">
                            <h5>User_3</h5>
                            <p class="text-bold">sipp</p>
                        </div>
                    </div>
                    <!----- MESSAGE ----->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./images/chad.jpg">
                        </div>
                        <div class="message-body">
                            <h5>User_4</h5>
                            <p class="text-bold">2 new messages</p>
                        </div>
                    </div>
                    <!----- MESSAGE ----->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./images/chad.jpg">
                        </div>
                        <div class="message-body">
                            <h5>User_5</h5>
                            <p class="text-muted">wkwkwkwk</p>
                        </div>
                    </div>
                    <!----- MESSAGE ----->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./images/chad.jpg">
                            <div class="active"></div>
                        </div>
                        <div class="message-body">
                            <h5>User_6</h5>
                            <p class="text-bold">main kui</p>
                        </div>
                    </div>
                </div>
                <!------------ END OF MESSAGES -------------->


                <!------------ FRIEND REQUESTS -------------->
                <div class="friend-requests">
                    <h4>Requests</h4>
                    <!----- REQUEST 1----->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./images/chad.jpg">
                            </div>
                            <div>
                                <h5>User_7</h5>
                                <p class="text-muted">8 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn">Decline</button>
                        </div>
                    </div>
                    <!----- REQUEST 2----->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./images/chad.jpg">
                            </div>
                            <div>
                                <h5>User_8</h5>
                                <p class="text-muted">2 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn">Decline</button>
                        </div>
                    </div>
                    <!----- REQUEST 3----->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./images/chad.jpg">
                            </div>
                            <div>
                                <h5>User_9</h5>
                                <p class="text-muted">19 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn">Decline</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!--====================== END OF RIGHT ==========================-->
        </div>
    </main>

 <!--================================================ THEME CUSTOMIZATION =============================================-->
 <div class="customize-theme">
    <div class="card">
        <h2>Customize your view</h2>
        <p class="text-muted">Manage your font size, color, and background.</p>

        <!------------ FONT SIZES ------------->
        <div class="font-size">
            <h4>Font Size</h4>
            <div>
                <h6>Aa</h6>
            <div class="choose-size">
                <span class="font-size-1"></span>
                <span class="font-size-2"></span>
                <span class="font-size-3"></span>
                <span class="font-size-4"></span>
                <span class="font-size-5"></span>
            </div>
            <h3>Aa</h3>
            </div>
        </div>

        <!------------ PRIMARY COLORS ------------->
        <div class="color">
            <h4>Color</h4>
            <div class="choose-color">
            <span class="color-1 active"></span>
            <span class="color-2"></span>
            <span class="color-3"></span>
            <span class="color-4"></span>
            <span class="color-5"></span>
            </div>
        </div>

        <!---------- BACKGROUND COLORS ------------>
        <div class="background">
            <h4>Background</h4>
            <div class="choose-bg">
                <div class="bg-1 active">
                    <span></span>
                    <h5 for="bg-1">Light</h5>
                </div>
                <div class="bg-2">
                    <span></span>
                    <h5>Dim</h5>
                </div>
                <div class="bg-3">
                    <span></span>
                    <h5 for="bg-3">Lights Out</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./dashboard.js"></script>
</body>
</html>