<?php
error_reporting(0);
include('../includes/dbh.inc.php');
session_start();

function getpcPart(){
     global $conn;
     $query = "SELECT * FROM pcPart;";
     $check = mysqli_query($conn, $query);
     while ($row = mysqli_fetch_assoc($check)) {
          $PartID = $row['partName'];
          echo "
          <div style='width:235px;' class=' fade-in shadow-md white ml-2 mr-1 mt-2 p-1 b-rad-5'>
               <img class='img2' src='admin/upload/".$row['image']."'/>
               <div style='font-size:20px;' class='p-1 text-center'>";
               $q = "SELECT * FROM pcpartcomp WHERE pcPartID = '$PartID';";
               $connect = mysqli_query($conn, $q);
               if($connect){
                    while($partrow = mysqli_fetch_row($connect)){
                         $partName = $partrow[1];
                    }
               }
               echo"<h2>$partName</h2><br>";
               echo"<div class='text-primary'>
               <p >{$row['partDesc']}</p>
               <p>Quantity:{$row['qty']}</p>
               <b>Price:&#8377;</b>{$row['price']}<p>
               </div>
               <div class='my-1'>
                    <a class='button-field text-deco-none  shadow-md' href='index.php?{$partName}'>Add to cart</a>
               </div>
          </div>
          </div>
          ";
     }
     
}
function getCompleteBuilts(){
     $query = "SELECT * FROM pc_details;";
     global $conn;
     $check = mysqli_query($conn, $query);
     while ($row = mysqli_fetch_assoc($check)) {
          $p_id = $row['pc_id'];
          echo "
          <div style='width:270px;' class='fade-in shadow-md text-center white m-1 p-1 b-rad-5'>
               <img class='img2 mt-1' src='./admin/upload/".$row['pc_image']."'/><br>
               <h3 style='margin-top:20px;'>{$row['pcName']}</h3>
               <div style='font-size:14px;' class='text-primary p-1'>
                    <b>Desktop Type:</b>{$row['PC_Type']}
                    <p align='left'><b>Motherboard:</b>{$row['motherboard']}</p><p align='left'>
                    <b>Processor:</b>{$row['processor']}</p>
                    <p align='left'><b>
                    Price:&#8377;</b>{$row['pcPrice']}</p><p align='left'><b>
                    Harddisk Volume:</b> {$row['hardDisk']}GB</p><p align='left'><b>
                    Monitor Company:</b> {$row['monitor']}</p><p align='left'><b>
                    Monitor Display:</b> {$row['monitor_display']}''</p><p align='left'><b>
                    Graphics Card Type:</b> {$row['graphics_card_type']}<p align='left'><b>
                    GC Capacity:</b> {$row['graphics_card']}GB</p><p align='left'><b>
                    Keyboard Company:</b>{$row['keyboard_company']}</p><p align='left'><b>
                    Mouse Company:</b>{$row['mouse_company']}</p><p align='left'><b>
                    Speaker Company:</b> {$row['speakers']}</p><p align='left'><b>
                    Ram Type:</b> {$row['ram_type']}</p><p align='left'><b>
                    Ram Company:</b> {$row['ram_company']}</p><p align='left'><b>
                    Ram Capacity:</b> {$row['ram_capacity']}GB</p>
               </div>
               <div class='my-1'>
               <a class='button-field text-deco-none shadow-md' href='index.php?{$p_id}'>Add to cart<a></div>
          </div>"
          ;} 
}

function loginORnot(){
     if(isset($_SESSION['userId'])){
          echo'<form action="includes/logout.inc.php" method="post">
          <div class="d-flex jcfe">
          <div class="cart-btn">
          <div style="font-size:30px;" class="nav-icon"><a href="./cart/cart.php"><i style="color:black;" class="fas fa-cart-plus"></i></a></div>
          <div class="cart-items">0</div>
          </div>
          <div style="font-size:30px; padding:0 15px;" class="text-black"><a class="text-black" href="account/myAccount.php?acc"><div class="mx-1" ><i class="fas fa-user-circle"></i></div></a></div>
          <div style="margin:10px 0;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="includes/logout.inc.php" name="logout-submit">Logout</a></div>
          </div>
          </form>';
      }
      else{
          echo'
          <div class="container d-flex flex-row jcfe">
              <div ><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="signup.php">Signup</a></div>
              <div><a class="text-deco-none text-black pr-1 mr-2 nav loginphp" href="login.php">Login</a></div>
          </div>
          ';
      }
}

function uploadCompleteBuild(){
     if(isset($_POST['upload'])){
          $file = $_FILES['file'];
          //print_r($file);
          $fileName = $_FILES['file']['name'];
          $fileTmpName = $_FILES['file']['tmp_name'];
  
          $folder = "uploadedimages/".$fileName;
          move_uploaded_file($fileTmpName, $folder);
  
          $compName = $_POST['compName'];
          $compType = $_POST['comp_type'];
          $motherboard = $_POST['motherboard'];
          $processor = $_POST['processor'];
          $pcDetailPrice = $_POST['pcDetailPrice'];
          $harddisk = $_POST['harddisk'];
          $monitor_company = $_POST['monitorCompany'];
           $monitor_display = $_POST['monitorDisplay'];
           $graphics_card_type = $_POST['graphicsCardType'];
           $graphics_card = $_POST['graphicsCard'];
           $keyboard_company = $_POST['keyboardCompany'];
           $mouse_company = $_POST['mouseCompany'];
           $speaker_company = $_POST['speakerCompany'];
           $ram_type = $_POST['ramType'];
           $ram_company = $_POST['ramCompany'];
           $ram_capacity = $_POST['ramCapacity'];
  
            if(empty($compType) || empty($motherboard) || empty($processor) || empty($pcDetailPrice) || empty($harddisk) || empty($monitor_company) || empty($monitor_display) || empty($graphics_card_type) || empty($graphics_card) || empty($keyboard_company) || empty($mouse_company) || empty($speaker_company) || empty($ram_type) || empty($ram_company) || empty($ram_capacity)){
              header("location: upload_pc_details.php?error=emptyfield");
            }
            else{
              $query = "INSERT INTO pc_details VALUES(NULL,'$folder','$compName', '$compType', '$motherboard', '$processor','$pcDetailPrice' , '$harddisk', '$monitor_company', '$monitor_display', '$graphics_card_type', '$graphics_card', '$keyboard_company', '$mouse_company', '$speaker_company', '$ram_type', '$ram_company', '$ram_capacity') ;";
              
              $check = mysqli_query($conn, $query);
              if($check){
                  
                  header("LOCATION: upload_pc_details.php?data=success");
                  
              }
              else{
                  header("LOCATION: upload_pc_details.php?data=unsuccess");
  
              }
            }
      }
}

function getMainPageCompletedBuilds(){
     $query = "SELECT * FROM pc_details;";
     global $conn;
     $check = mysqli_query($conn, $query);
     while ($row = mysqli_fetch_assoc($check)) {
          $p_id = $row['pc_id'];
          echo "
          <div style='width:270px;' class='fade-in shadow-md text-center white m-1 p-1 b-rad-5'>
               <img class='img2 mt-1' src='../admin/upload/".$row['pc_image']."'/><br>
               <h3 style='margin-top:20px;'>{$row['pcName']}</h3>
               <div style='font-size:14px;' class='text-primary p-1'>
                    <b>Desktop Type:</b>{$row['PC_Type']}
                    <p align='left'><b>Motherboard:</b>{$row['motherboard']}</p><p align='left'>
                    <b>Processor:</b>{$row['processor']}</p>
                    <p align='left'><b>
                    Price:&#8377;</b>{$row['pcPrice']}</p><p align='left'><b>
                    Harddisk Volume:</b> {$row['hardDisk']}GB</p><p align='left'><b>
                    Monitor Company:</b> {$row['monitor']}</p><p align='left'><b>
                    Monitor Display:</b> {$row['monitor_display']}''</p><p align='left'><b>
                    Graphics Card Type:</b> {$row['graphics_card_type']}<p align='left'><b>
                    GC Capacity:</b> {$row['graphics_card']}GB</p><p align='left'><b>
                    Keyboard Company:</b>{$row['keyboard_company']}</p><p align='left'><b>
                    Mouse Company:</b>{$row['mouse_company']}</p><p align='left'><b>
                    Speaker Company:</b> {$row['speakers']}</p><p align='left'><b>
                    Ram Type:</b> {$row['ram_type']}</p><p align='left'><b>
                    Ram Company:</b> {$row['ram_company']}</p><p align='left'><b>
                    Ram Capacity:</b> {$row['ram_capacity']}GB</p>
               </div>
               <div class='my-1'>
               <a class='button-field text-deco-none' href='buy/buyOrLogin.php'>Buy Now<a></div>
          </div>"
          ;} 
}
?>