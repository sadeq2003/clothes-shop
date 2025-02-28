<?php
 session_start();
include('../shopping/include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../logos/store-logo.jpg">
    
    <title> shop page</title>
</head>
<body>
    
    <section id="header">
        <div>
            <a href="../php/index.html"><img src="../logos/logoheader.png" alt="store-logo" class="logo" id="logo"></a>
        </div>
        <div>
            
            <ul id="navbar">
                <li><a href="../php/index.html" >Home</a></li>
                <li><a href="../php/shop.php"  class="active">Shop</a></li>
                <li><a href="../php/market.php">market</a></li>
                <li><a href="al.php">VR</a></li>
                <li><a href="../php/payment.php"><i class="fa-solid fa-cart-plus"></i></a></li>
                <li><a href="../admin/login.php"><i class="fa-solid fa-user"></i></a></li>
                <li ><i  class="fa-solid fa-circle-xmark" id="close"></i></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="../php/catr.php"><i class="fa-solid fa-cart-plus"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
            
        </div>
    </section>
    <section id="productdetails" class="section-p1">
    <?php  
    $id = $_GET['id'];
    if (isset($_GET['id'])) {
        $query = "SELECT * FROM product WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
        <div class="single_product_imges">
            <img src="../shopping/include/imgupload/<?php echo $row['proimg']; ?>" alt="" width="100%" id="MainImg">
        </div>
        
        <div class="product_description">
            <h5><?php echo $row['proname']; ?></h5>
            <h2><?php echo $row['prosection']; ?></h2>
            <h4><?php echo $row['proprice']; ?> <span>$</span></h4>

            <div class="select">
                <input type="number" name="quantity" id="quantity" value="1">
                <select>
                    <option value="xl">xl</option>
                    <option value="xll">xll</option>
                    <option value="small">small</option>
                    <option value="large">large</option>
                </select>
            </div>

            <form action="payment.php" method="post">
                <input type="hidden" name="proname" value="<?php echo $row['proname']; ?>">
                <input type="hidden" name="prosize" value="<?php echo isset($row['prosize']) ? $row['prosize'] : 'حجم غير محدد'; ?>">
                <input type="hidden" name="proprice" value="<?php echo $row['proprice']; ?>">
                <input type="hidden" name="proimg" value="<?php echo $row['proimg']; ?>">
                <button type="submit" name="add_to_cart" class="button">
                    <i class="fas fa-shopping-cart"></i> أضف إلى السلة
                </button>
            </form>

            <h4><?php echo $row['prodesc']; ?></h4>
            <span><?php echo $row['pronamber']; ?></span>

            <div class="small_images">
                <div class="small-img">
                    <img src="../shopping/include/imgupload/<?php echo $row['proimg']; ?>" alt="small_images" class="small_image" width="100%" id="small-img">
                </div>
                <div class="small-img">
                    <img src="../clotes/11.jpg" alt="small_images" class="small_image" width="100%" id="small-img">
                </div>
                <div class="small-img">
                    <img src="../clotes/12.jpg" alt="small_images" class="small_image" width="100%" id="small-img">
                </div>
                <div class="small-img">
                    <img src="../clotes/12.jpg" alt="small_images" class="small_image" width="100%" id="small-img">
                </div>
            </div>
        </div>
    <?php } ?>
</section>

  
   <section id="product1" class="section-p1" >
    <div class="pro-continer">
        
         <?php
        $query = "SELECT * FROM product";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['prooff'] >= 50) { // التحقق من نسبة الخصم
        ?>
                <div class="products" onclick="window.location.href='single_product.php?id=<?php echo $row['id']; ?>';">
                    <img src="../shopping/include/imgupload/<?php echo $row['proimg']; ?>" alt="">
                    <div class="product-dec">
                        <span><?php echo $row['proname']; ?></span>
                        <h5><?php echo $row['prodesc']; ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4><?php echo $row['proprice']; ?></h4>
                        <p>الخصم: <?php echo $row['prooff']; ?>%</p> <!-- عرض نسبة الخصم -->
                       
                  <form action="payment.php" method="post">
                    <input type="hidden" name="proname" value="<?php echo $row           ['proname']; ?>">
                   <input type="hidden" name="prosize" value="<?php echo isset           ($row['prosize']) ? $row['prosize'] : 'حجم غير محدد'; ?>">
                   <input type="hidden" name="proprice" value="<?php echo $row           ['proprice']; ?>">
                    <input type="hidden" name="proimg" value="<?php echo $row           ['proimg']; ?>">
                     <button type="submit" name="add_to_cart" class="button">
                     <i class="fas fa-shopping-cart"></i> أضف إلى السلة
                    </button>
                </form>    
                    </div>
                </div>
        <?php 
            } 
        } // نهاية الحلقة
        ?>
        

        
</section>
    <section  id="newsletters" class="single_product_newsletters" class="section-p1">
        <div class="newstext">
            <h4>
                Sign Up For Newsletters
            </h4>
            <h6>
                Get E-mail updates our latest shop and <span>speacial offers.</span>
            </h6>
        </div>
         <div class="form">
                <form action="get">
                    <input type="email" placeholder="Your email address">
                <button >
                    Sign Up
                </button>
                </form>

        </div>
        
    </section>
    <footer class="section-p1">
        <a href="../php/index.html"><img src="../logos/logoheader.png" alt="store-logo"></a>
        <div class="footer-1">
            
            <h4>contact</h4>
            <p><span>Address:</span> Iraq \ Mosul street 43 </p>
            <p><span>Phone:</span> +964 7511380910 </p>
            <p><span>Hours:</span> 10:00 AM - 14:00 PM </p>
               
            <h4>Follow Us</h4>

            <div class="lcon-contax">
                <a href="https://www.facebook.com/Sadeqpp?mibextid=LQQJ4d"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.instagram.com/sadeq_deve/profilecard/?igsh=MW9jN2VoaXVsdnp6OQ=="><i class="fa-brands fa-instagram"></i></a>
            <a href="https://pin.it/1rR3ALxYJ"><i class="fa-brands fa-pinterest"></i></a>
            <a href="+9647511380910"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
            
        </div>
        <div class="footer-2">
            
            <h4>My Account</h4>
            <p><a href="">Sign in</a></p>
            <p>
                <a href="">View Cart</a>
            </p>
            <p>
                <a href="">Our location</a>
            </p>
            <p>
                <a href="">Contact Us</a>
            </p>
            
           
        </div>
        
        <div class="footer-3">
             
            <iframe  class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3212.3767215200282!2d43.14357580000001!3d36.37587330000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4007952095d93f87%3A0xb4047df302a5b21b!2sUniversity%20of%20Mosul!5e0!3m2!1sen!2siq!4v1731248930925!5m2!1sen!2siq" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
       
    </footer>
   
    <script>
        var MainImg = document.getElementById("MainImg");
    
        // اختيار جميع الصور الصغيرة
        var small_image = document.getElementsByClassName("small_image");
    
        // إضافة حدث النقر لكل صورة صغيرة
        small_image[0].onclick = function(){
            MainImg.src=small_image[0].src;
        }
        small_image[1].onclick = function(){
            MainImg.src=small_image[1].src;
        }
        small_image[2].onclick = function(){
            MainImg.src=small_image[2].src;
        }
        small_image[3].onclick = function(){
            MainImg.src=small_image[3].src;
        }
    </script>
    <script src="../php/javascript.js"></script>
</body>
</html> 