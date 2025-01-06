<?php
 session_start();
 include('../shopping/include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="logos/logoheader.png">
    
    <title>store shoping</title>
</head>
<body>
    
    <section id="header">
        <div>
            <a href="../php/index.html"><img src="../logos/logoheader.png" alt="store-logo" class="logo" id="logo"></a>
        </div>
        <div>
            
            <ul id="navbar">
                <li><a href="#index.html" >Home</a></li>
                <li><a href="../php/shop.html">Shop</a></li>
                <li><a href="#market.html">market</a></li>
                <li><a href="#live-test.html">live-test</a></li>
                <li><a href="../php/payment.html"><i class="fa-solid fa-cart-plus"></i></a></li>
                <li><a href="../admin/login.php" class="active"><i class="fa-solid fa-user" ></i></a></li>
                <li ><i  class="fa-solid fa-circle-xmark" id="close"></i></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="catr.html"><i class="fa-solid fa-cart-plus"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
            
        </div>
    </section>
    

    </body>
</html>