<?php
    error_reporting(0);
    include("../includes/dbh.inc.php");
    if(isset($_POST['admininsert'])){
        $adminName = $_POST['signup-email'];
        $adminPassword = $_POST['signup-password'];
        // print($adminName);
        $adminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
        $adminInsert = "INSERT INTO admin VALUES(NULL, '$adminName','$adminPassword')";
        $check = mysqli_query($conn, $adminInsert);

    }
?>
<!DOCTYPE html>
 <html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../customstyle.css">
        <style>
            .flex-container{
                height:70vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .admin-input{
                width: 250px;
                height: 45px;
                margin: 10px;
                outline: none;
                border-radius: 10px;
                border: 1px solid gray;
                padding: 10px;
                transition: ease-in-out, width .35s ease-in-out;
            }
            .admin-input:focus{
                width: 270px;
                border: 2px solid #696969;
            }
            #submit{
                margin: 20px;
                width: 100px;
                padding: 10px;
                outline: none;
                background: #28AB87;
                color: white;
                border: none;
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-container">
            <div class="white px-4 py-2 b-rad-2 shadow-md">
                <div class="text-center py-1">
                    <h4 style="color:gray">Make Admin</h4>
                </div>
                <div>
                    <!-- SIGN UP MODAL -->
                <div id="modal-signup" class="modal">
                    <div class="modal-content">
                        <form action="" method="POST">
                            <div class="">
                                <input class="admin-input" type="email" name="signup-email" placeholder="Enter Email to make Admin..." required />
                            </div>
                            <div class="">
                                <input class="admin-input" type="password" name="signup-password" placeholder="Enter Password..." required />
                            </div>
                            <div class="text-center">
                                <input id="submit" name="admininsert" type="submit">
                            </div>
                            <p class="error pink-text center-align"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
 </html>