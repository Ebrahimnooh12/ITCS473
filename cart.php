<?php
session_start();
extract($_GET);
require("res_data.php");           

if(isset($state)) {

    if($state == 1)
            unset($_SESSION['mycart'][$id]);
}

if(isset($update)) {
    if($upq == 0)
        unset($_SESSION['mycart'][$update]);
    else    
        $_SESSION['mycart'][$update][2]=$upq;
}




try{
    require("connection.php");
    $sql = "select type from category ";
    $dishsql = "select * from dish INNER JOIN category ON dish.ct_id = category.qid ORDER BY RAND();";
   
    $rs1= $db->query($sql);
    $rs2= $db->query($sql);
    $dish = $db->query($dishsql);

    

    if(isset($_SESSION['activeuser']))
    {
        $user=$_SESSION['activeuser'][0];
        $account_sql="select * from customer where username='$user';";

        $account = $db->query($account_sql);


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
    <title>E&E - Electronics eCommerce Bootstrap4 HTML Template</title>
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
        #propic {
            width:50px;  
            border-radius: 10%;
            border:1px solid #f5d730;
        }

        #propic:hover{
            border:1px solid #000;
        }

    
    </style>
</head>

<body>
<!-- Header Section Start -->
<div class="header-section section">

    <!-- Header Top Start -->
    <div class="header-top header-top-one header-top-border pt-10 pb-10">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col order-12 order-xs-12 order-lg-2 mt-10 mb-10">
                    <!-- Header Advance Search Start -->
                    <div class="header-advance-search">
                        
                        <form action="#">
                            <div class="input"><input type="text" placeholder="Search your dish"></div>
                            <div class="submit"><button><i class="icofont icofont-search-alt-1"></i></button></div>
                        </form>
                        
                    </div><!-- Header Advance Search End -->
                </div>
                      <div class="col order-2 order-xs-2 order-lg-12 mt-10 mb-10">
                         <!-- Header Account Links Start -->
                        <div class="header-account-links">
                              
                              <?php  
                              if(isset($_SESSION['activeuser'])){
                              foreach ($account as $row) {?>
                                <a href="myaccount.php"><img id='propic' src="assets/images/userpic/<?php echo $row['profile_pic'];?>"> <span><?php echo $row['username'];?></span></a>
                                 <a href="logout.php"><i class="icofont icofont-login d-none"></i> <span>Logout</span></a>

                              <?php }}
                              
                              else {?>

                                <a href="register.html"><span>Register</span></a>
                                <a href="login.php"><i class="icofont icofont-login d-none"></i> <span>Login</span></a>

                              <?php } ?>

                        </div><!-- Header Account Links End -->
                    </div>

            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Bottom Start -->
    <div class="header-bottom header-bottom-one header-sticky">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-15 mb-15">
                    <!-- Logo Start -->
                    <div class="header-logo">
                        <a href="index.php">
                            <img src="assets/images/pic/logo.png"  width="100" height="100">
                            <img class="theme-dark" src="assets/images/logo-light.png">
                        </a>
                    </div><!-- Logo End -->
                </div>

                <div class="col order-12 order-lg-2 order-xl-2 d-none d-lg-block">
                   <!-- Main Menu Start -->
                   <div class="main-menu">
                        <nav>
                            <ul>
                                <li class="active"><a href="index.php">HOME</a></li>
                                <li class="menu-item-has-children"><a href="#">Descover</a>
                                    <ul class="mega-menu two-column">
                                        <li><a href="#">Menu</a>
                                            <ul>
                                                <li><a href="dish-grid.php">Dish</a></li>
                                                <li><a href="best-deals.php">Best Deals</a></li>
                                                <li><a href="fullcategory.php">Category</a></li>
                                            </ul>
                                        </li>

                                        <li><a href="#">Account</a>
                                            <ul>
                                                <li><a href="myaccount.php">My Account</a></li>
                                                <li><a href="cart.php">Cart</a></li>
                                                <li><a href="checkout.php">Checkout</a></li>
                                                <li><a href="register.html">Register</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="contact.php">CONTACT</a></li>

                            </ul>
                        </nav>
                    </div><!-- Main Menu End -->
                </div>

                <div class="col order-2 order-lg-12 order-xl-12">
                    <!-- Header Shop Links Start -->
                    <div class="header-shop-links">
                        
                        <!-- Cart -->
                        <a href="cart.php" class="header-cart"><i class="ti-shopping-cart"></i> <span class="number"><?php echo count($_SESSION['mycart']); ?> </span></a>
                        
                    </div><!-- Header Shop Links End -->
                </div>
                
                <!-- Mobile Menu -->
                <div class="mobile-menu order-12 d-block d-lg-none col"></div>

            </div>
        </div>
    </div><!-- Header Bottom End -->

    <!-- Header Category Start -->
    <div class="header-category-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    
                    <!-- Header Category -->
                    <div class="header-category">
                        
                        <!-- Category Toggle Wrap -->
                        <div class="category-toggle-wrap d-block d-lg-none">
                            <!-- Category Toggle -->
                            <button class="category-toggle">Categories <i class="ti-menu"></i></button>
                        </div>
                        
                        <!-- Category Menu -->
                        <nav class="category-menu">
                            <ul sty>
                            <?php 
                                $m=0;
                                foreach($rs2 as $row) {
                                    if($m != 9)
                                    {   $type = $row["type"];
                                        echo "<li><a href='dish-grid.php?typ=$type'>";
                                        echo $row["type"];
                                        echo"</a></li>";
                                        ++$m;
                                    }
                                    else
                                       break;
                                }
                                ?>    
                                <li><a href="fullcategory.php">More</a></li>
                            </ul>
                        </nav>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div><!-- Header Category End -->

</div><!-- Header Section End -->

<!-- Mini Cart Wrap Start -->                      
<div class="mini-cart-wrap">

        <!-- Mini Cart Top -->
        <div class="mini-cart-top">    
        
            <button class="close-cart">Close Cart<i class="icofont icofont-close"></i></button>
            
        </div>
    

    <!-- Mini Cart dish -->
    <ul class="mini-cart-products">
        <?php 
        $total=0; 
        if(!empty($_SESSION['mycart'])){
        foreach($_SESSION['mycart'] as $k=>$v) {
            $name=$v[0];
            $price=$v[1];
            $q=$v[2];
            $p=$v[3];
            
            $total += $price * $q;
        ?>
     
        <li>
            <a class="image"><img src="<?php echo $p?>" alt="Product"></a>
            <div class="content">
                <a href="single-dish.php?d='<?php echo $k ?>'" class="title"><?php echo $name ?></a>
                <span class="price"><?php echo $price ?>BD</span>
                <span class="qty">Qty:<?php echo $q ?></span>
            </div>
            <button class="remove" onclick="window.location.href='index.php?state=1&id=<?php echo $k ?>'"><i class="fa fa-trash-o"></i></button>
        </li>

        <?php }}?>
    </ul>

    
    <!-- Mini Cart Bottom -->
    <div class="mini-cart-bottom">    
    
        <h4 class="sub-total">Total: <span> <?php echo $total ?> BD</span></h4>

        <div class="button">
            <a href="cart.php">ORDER</a>
        </div>
        
    </div>
    
    </div><!-- Mini Cart Wrap End --> 
    

<!-- Cart Overlay -->
<div class="cart-overlay"></div>

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-4 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>Cart</h1>
            </div>
        </div>

        <!-- Banner -->
        <div class="col-lg-4 col-md-6 col-12 order-lg-1">
                <div class="banner"><a href="#"><img src="assets/images/pic/BeFunky-collage (2).jpg" alt="Banner"></a></div>
            </div>
    
            <!-- Banner -->
            <div class="col-lg-4 col-md-6 col-12 order-lg-3">
                <div class="banner"><a href="#"><img src="assets/images/pic/BeFunky-collage (2).jpg" alt="Banner"></a></div>
            </div>
            
    </div>
</div><!-- Page Banner Section End -->

<!-- Cart Page Start -->
<div class="page-section section pt-90 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">				
                    <!-- Cart Table -->
                    <div class="cart-table table-responsive mb-40">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Dish</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-subtotal">Update</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            
                            <?php
                            if(!empty($_SESSION['mycart'])){
                            if(count($_SESSION['mycart'])==0) {  ?>
                                        <tbody>
                                            <tr><th class='empty' colspan='7'> YOUR CART IS EMPTY</th></tr>
                                        </tbody>



                            <?php } else {$total=0; foreach($_SESSION['mycart'] as $k=>$v) {

                                    $name=$v[0];
                                    $price=$v[1];
                                    $q=$v[2];
                                    $p=$v[3];
                                    $subt= $price * $q;
                                    $total += $price * $q;
                             ?>
                            <tbody>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img src="<?php echo $p ?>" alt="Product"></a></td>
                                    <td class="pro-title"><a href="#"><?php echo $name ?></a></td>
                                    <td class="pro-price"><span><?php echo $price ?> BD</span></td>
                                    <td class="pro-quantity"><div class="pro-qty"><form method="get"><input type="text" value="<?php echo $q ?>" name="upq"></div></td>
                                    <td class="pro-subtotal"><span><?php echo $subt ?></span></td>
                                    <td>
                                    <input type="hidden" name="update" value='<?php echo $k?>'>
                                    <input type="submit" value="Update">
                                    </form>
                                    </td>
                                    <td class="pro-remove"><a href='cart.php?state=1&id=<?php echo $k ?>'><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            </tbody>

                            <?php }}}?>
                        </table>
                    </div>
                    
                </form>	
                    
                <div class="row">

                    <div class="col-lg-6 col-12 mb-15">
                        <!-- Discount Coupon -->
                        <div class="discount-coupon">
                            <h4>Discount Coupon Code</h4>
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="text" placeholder="Coupon Code">
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="submit" value="Apply Code">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-6 col-12 mb-40 d-flex">
                        <div class="cart-summary">
                            <div class="cart-summary-wrap">
                                <h4>Cart Summary</h4>
                                <p>Total <span><?php echo $total ?> BD</span></p>
                                <h2>Grand Total <span><?php echo $total ?> BD</span></h2>
                            </div>
                            <div class="cart-summary-button">


                                <form action="
                                <?php if(isset($_SESSION['activeuser']))
                                            echo 'checkout.php?order=1';
                                      else
                                            echo 'login.php';
                                            
                                 ?>           
                                " method="post" align='right'>

                                    <input type="submit" value="Checkout">
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End --> 

<!-- Banner Section Start -->
<div class="banner-section section mb-90">
    <div class="container">
        <div class="row">
            
            <!-- Banner -->
            <div class="col-12">
                <div class="banner"><a href="#"><img src="assets/images/pic/BeFunky-collage (2).jpg" width="1170" height="350" alt="Banner"></a></div>
            </div>
            
        </div>
    </div>
</div><!-- Banner Section End -->

<!-- Brands Section Start -->
<div class="brands-section section mb-90">
    <div class="container">
        <div class="row">
            
            <!-- Brand Slider Start -->
            <div class="brand-slider col">
                <div class="brand-item col"><img src="assets/images/brands/brand-1.png" alt="Brands"></div>
                <div class="brand-item col"><img src="assets/images/brands/brand-2.png" alt="Brands"></div>
                <div class="brand-item col"><img src="assets/images/brands/brand-3.png" alt="Brands"></div>
                <div class="brand-item col"><img src="assets/images/brands/brand-4.png" alt="Brands"></div>
                <div class="brand-item col"><img src="assets/images/brands/brand-5.png" alt="Brands"></div>
            </div><!-- Brand Slider End -->
            
        </div>
    </div>
</div><!-- Brands Section End -->

<!-- Subscribe Section Start -->
<div class="subscribe-section section bg-gray pt-55 pb-55">
        <div class="container">
            <div class="row align-items-center">
                
                <!-- Mailchimp Subscribe Content Start -->
                <div class="col-lg-6 col-12 mb-15 mt-15">
                    <div class="subscribe-content">
                        <h2>SUBSCRIBE <span>OUR NEWSLETTER</span></h2>
                        <h2><span>TO GET LATEST</span> DISH UPDATE</h2>
                    </div>
                </div><!-- Mailchimp Subscribe Content End -->
                
                
                <!-- Mailchimp Subscribe Form Start -->
                <div class="col-lg-6 col-12 mb-15 mt-15">
                    
                    <form class="subscribe-form" action="#">
                        <input type="email" autocomplete="off" placeholder="Enter your email here" />
                        <button >subscribe</button>
                    </form>
                    <!-- mailchimp-alerts Start -->
                    <div class="mailchimp-alerts text-centre">
                        <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                        <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                        <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                    </div><!-- mailchimp-alerts end -->
                    
                </div><!-- Mailchimp Subscribe Form End -->
                
            </div>
        </div>
    </div><!-- Subscribe Section End -->
    
    <!-- Footer Section Start -->
    <div class="footer-section section bg-ivory">
       
        <!-- Footer Top Section Start -->
        <div class="footer-top-section section pt-90 pb-50">
            <div class="container">
               
                <!-- Footer Widget Start -->
                <div class="row">
                    <div class="col mb-90">
                        <div class="footer-widget text-center">
                            <div class="footer-logo">
                                    <img src="assets/images/pic/logo.png"  width="100" height="100">
                                    <img class="theme-dark" src="assets/images/logo-light.png" alt="E&E - Electronics eCommerce Bootstrap4 HTML Template">
                            </div>
                            <p>Cooking is all about people. Food is maybe the only universal thing that really has the power to bring everyone together. No matter what culture, everywhere around the world, people get together to eat.</p>
                        </div>
                    </div>
                </div><!-- Footer Widget End -->
                
                <div class="row">
                    
                    <!-- Footer Widget Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-40">
                    <div class="footer-widget">
                       
                        <h4 class="widget-title">CONTACT INFO</h4>
                        
                        <p class="contact-info">
                            <span>Address</span>
                            <?php
                            
                            $c_add = count($data[0]);
                            $c_tel = count($data[1]);
                            $c_web = count($data[2]);

                            for ($i=0; $i <  $c_add; $i++) { 
                                echo $data[0][$i].'</br>';
                            }
                            ?>
                        </p>
                        
                        <p class="contact-info">
                            <span>Phone</span>
                            <?php
                            for ($i=0; $i <  $c_tel; $i++) { 
                                echo $data[1][$i].'</br>';
                            }
                            ?>
                        </p>
                        
                        <p class="contact-info">
                            <span>Web</span>
                            <?php
                            for ($i=0; $i <  $c_tel; $i++) { 
                                echo "<a href='#'>".$data[2][$i]."</a></br>";
                            }
                            ?>
                            
                        </p>
                        
                    </div>
                </div><!-- Footer Widget End -->
                </div>
                
            </div>
        </div><!-- Footer Bottom Section Start -->
       
        
    </div><!-- Footer Section End -->


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

</body>

</html>