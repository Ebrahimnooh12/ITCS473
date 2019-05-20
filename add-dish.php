<?php
session_start();
extract($_GET);
extract($_POST);

        

if(!isset($_SESSION['admin'])){
    header('location: login.php');
    die();
}

if(isset($out)){
    unset($_SESSION['admin']);
    header('location: login.php');
    die();
}





    $staffun = $_SESSION['admin'][0];
    $staffid = $_SESSION['admin'][1];


    try{
        require("connection.php");
        $cat_sql = "select * from category ;";
        $offer_sql ="select fid,offer from offer;";
       
        $cat = $db->query($cat_sql);
        $offer = $db->query($offer_sql);

        if(isset($dish_add)) {
            $stmt = $db->prepare("INSERT INTO dish (name, description, ct_id,price,rate,pic,fid) VALUES (:dish, :desc, :cat, :p,'1','assets/images/dish_def.jpg',:offer)");
            
            $stmt->bindParam(':dish', $dish);
            $stmt->bindParam(':desc', $desc);
            $stmt->bindParam(':cat', $c);
            $stmt->bindParam(':p', $price);
            $stmt->bindParam(':offer', $off);


            $stmt->execute();


    
        }


        $db = null;
        
    
    }
    
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }


?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>D&D - Food Ordring</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    
    <!-- CSS
	============================================ -->
   <!-- our css -->
   <link rel="stylesheet" href="assets/css/ourStyle.css"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/icon-font.min.css">
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <style>
        .nice-text{
            border-radius:3%;
                }
    
    
    
    </style>
</head>

<body>
<div class="header-section section">    
<div class="header-top header-top-one header-top-border pt-10 pb-10">
        <div class="container">
            <div class="row align-items-center justify-content-between">


                <div class="col order-2 order-xs-2 order-lg-12 mt-10 mb-10">
                    <!-- Header Account Links Start -->
                    <div class="header-account-links">
                    <a href="staffaccount.php"><i class="icofont icofont-user-alt-7"></i> <span><?php echo $staffun;?></span></a>
                    <a href="StaffDashBoard.php?out=1"><i class="icofont icofont-login d-none"></i> <span>Logout</span></a>
                    </div><!-- Header Account Links End -->
                </div>

            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Bottom Start -->
    <div class="header-bottom header-bottom-one header-sticky">
        <div class="container">
            <div class="row align-items-center">

                <div class="mt-15 mb-15">
                    <!-- Logo Start -->
                    <div class="header-logo">
                        <a href="AdmenDashBoard.php">
                            <img src="assets/images/pic/logo.png"  width="100" height="100">
                            <img class="theme-dark" src="assets/images/logo-light.png">
                        </a>
                    </div><!-- Logo End -->
                </div>

                <div class="col order-12 order-lg-2 order-xl-2 d-none d-lg-block">
                   <!-- Main Menu Start -->
                   <div class="main-menu" style='margin-left:35%'>
                        <nav>
                            <ul>
                                <li class="active"><a href="AdminDashBoard.php">HOME</a></li>
                                <li class="menu-item-has-children"><a href="#">Resturant Managment</a>
                                    <ul class="mega-menu three-column">
                                        <li><a href="#">DISHS</a>
                                            <ul>
                                                <li><a href="adminview.php?v=d">VIEW DISH</a></li>
                                                <li><a href="add-dish.php">ADD DISH</a></li>
                                                <li><a href="adminview.php?v=g">CATEGORY</a></li>
                                                <li><a href="#">OFFER</a></li>
                                                <li><a href="#">REVIWES</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">ACCOUNTS</a>
                                            <ul>
                                                <li><a href="adminview.php?v=s">STAFF</a></li>
                                                <li><a href="adminview.php?v=c">CUSTOMER</a></li>
                                            </ul>
                                        </li>

                                        <li><a href="#">RESTURANT</a>
                                            <ul>
                                                <li><a href="#">INFORAMATION</a></li>
                                                <li><a href="#">ORDER</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="#">My ACCOUNT</a></li>

                            </ul>
                        </nav>
                    </div><!-- Main Menu End -->
                </div>
                
                <!-- Mobile Menu -->
                <div class="mobile-menu order-12 d-block d-lg-none col"></div>

            </div>
        </div>
    </div><!-- Header Bottom End -->
</div>



        <!--  my account Start -->
<div class="register-section section mt-90 mb-90">
    <div class="container">
        <div class="row">
            <!-- My account -->
            <div class="col-md-6 col-12 d-flex">
                <div class="ee-register">    
                    <!-- my account Form -->
                    <form method='post'>
                        <div class="row">
                            <div class="col-12 mb-30"><h4><b>Dish</b></h4><input name='dish' placeholder='Enter Dish Name'></div>
                            <div class="col-12 mb-30"><h4><b>Category</b></h4>
                                <select name="c" class="nice-select">
                                    <?php foreach($cat as $k){?>
                                            <option value='<?php echo $k['qid'];?>'><?php echo $k['type'];?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="col-12 mb-30"><h4><b>Description</b></h4><textarea name="desc" rows='10' cols='50' class='nice-text' placeholder='Enter Dish Description'></textarea></div>                          
                            <div class="col-12 mb-30"><h4><b>Price</b></h4><input type='number' min='0.001' step='0.001' name='price' placeholder='Enter Dish Price'></div>                            
                            


                            <div class="col-12 ml-150"><input  id='sub' type="submit" value="ADD" name='dish_add'></div>   
                        </div>
                    </form>
                </div>
            </div>
                        <!-- Account Image -->
            <div class="col-md-5 col-12 d-flex">
                
                <div class="ee-account-image">                    
                    <img id='img-back' src="assets/images/dish_def.jpg" alt="Account Image Placeholder" class="image-placeholder" width='250'>
                    
                    <div class="account-image-upload">
                        <input type="file" name="chooseFile" id="account-image-upload">
                        <label class="account-image-label" for="account-image-upload">Choose image</label>
                    </div>
                    
                    <p>jpEG 250x250</p>
                    
                </div>
            </div>
    </div>
</div><!-- my account Section End -->




<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper JS -->
<script src="assets/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>

<!-- Main JS -->
<script src="assets/js/main.js"></script>

<!-- our js -->
<script src="assets/js/script.js"></script>
</body>

</html>