<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="logos/logoheader.png">
</head>

<body>
     
    <section id="header">
        <div>
            <a href="index.html"><img src="../logos/logoheader.png" alt="store-logo" class="logo" id="logo"></a>
        </div>
        <div>
            
            <ul id="navbar">
                <li><a href="../php/index.html" >Home</a></li>
                <li><a href="../php/shop.php"  >Shop</a></li>
                <li><a href="#market.html">market</a></li>
                <li><a href="al.php">VR</a></li>
                <li><a href="../php/payment.php" class="active">
                    <i class="fa-solid fa-cart-plus"></i></a></li>
                    <li><a href="../admin/login.php"><i class="fa-solid fa-user"></i></a></li>
                <li ><i  class="fa-solid fa-circle-xmark" id="close"></i></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="../php/payment.html"><i class="fa-solid fa-cart-plus"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
            
        </div>
    </section>
    <section id="hero-payment">
        
        <h1>#cart-s</h1>
        <p>قائمة الشراء الخاصة \ خصوم حتى %70</p>
           
       
   </section>
   <section id="cart" class="section-p1">
    <hr id="hr-line">
    <table width="100%">
        <thead>
            <tr>
                <td>
                    ازالة
                </td>
                <td>
                    صورة
                </td>
                <td>
                    المنتج
                </td>
                <td>
                    السعر
                </td>
                <td>
                    الكمية
                </td>
                <td>
                    التكلفة
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                   <a href=""><i class="far fa-times-circle"></i></a> 
                </td>
                <td>
                    <img src="../clotes/4.jpg" alt="">
                </td>
                <td>
                    hody t-shirt
                </td>
                <td>
                    15$
                </td>
                <td>
                    <input type="namber" value="1">
                </td>
                <td>
                    15$
                </td>
            </tr>
            <tr>
                <td>
                   <a href=""><i class="far fa-times-circle"></i></a> 
                </td>
                <td>
                    <img src="../clotes/4.jpg" alt="">
                </td>
                <td>
                    hody t-shirt
                </td>
                <td>
                    15$
                </td>
                <td>
                    <input type="namber" value="1">
                </td>
                <td>
                    15$
                </td>
            </tr>
            <tr>
                <td>
                   <a href=""><i class="far fa-times-circle"></i></a> 
                </td>
                <td>
                    <img src="../clotes/4.jpg" alt="">
                </td>
                <td>
                    hody t-shirt
                </td>
                <td>
                    15$
                </td>
                <td>
                    <input type="namber" value="1">
                </td>
                <td>
                    15$
                </td>
            </tr>
        </tbody>

    </table>
    
   </section>
   
 <section id="Payment-page" class="section-p1">
    <div class="container">

        <form action="get">

            <div class="row">

                <div class="col">
                    <h3 class="title">
                        Billing Address
                    </h3>

                    <div class="inputBox">
                        <label for="name">
                              Full Name:
                          </label>
                        <input type="text" id="name" 
                               placeholder="Enter your full name" 
                               required>
                    </div>

                    <div class="inputBox">
                        <label for="email">
                              Email:
                          </label>
                        <input type="text" id="email" 
                               placeholder="Enter email address" 
                               required>
                    </div>

                    <div class="inputBox">
                        <label for="address">
                              Address:
                          </label>
                        <input type="text" id="address" 
                               placeholder="Enter address" 
                               required>
                    </div>

                    <div class="inputBox">
                        <label for="city">
                              City:
                          </label>
                        <input type="text" id="city" 
                               placeholder="Enter city" 
                               required>
                    </div>

                    <div class="flex">

                        <div class="inputBox">
                            <label for="state">
                                  State:
                              </label>
                            <input type="text" id="state" 
                                   placeholder="Enter state" 
                                   required>
                        </div>

                        <div class="inputBox">
                            <label for="zip">
                                  Zip Code:
                              </label>
                            <input type="number" id="zip" 
                                   placeholder="123 456" 
                                   required>
                        </div>

                    </div>

                </div>
                <div class="col">
                    <h3 class="title">Payment</h3>

                    <div class="inputBox">
                        <label for="name">
                              Card Accepted:
                          </label>
                        <img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20240715140014/Online-Payment-Project.webp" 
                             alt="credit/debit card image">
                    </div>

                    <div class="inputBox">
                        <label for="cardName">
                              Name On Card:
                          </label>
                        <input type="text" id="cardName" 
                               placeholder="Enter card name" 
                               required>
                    </div>

                    <div class="inputBox">
                        <label for="cardNum">
                              Credit Card Number:
                          </label>
                        <input type="text" id="cardNum" 
                               placeholder="1111-2222-3333-4444" 
                               maxlength="19" required>
                    </div>

                    <div class="inputBox">
                        <label for="">Exp Month:</label>
                        <select name="" id="">
                            <option value="">Choose month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>


                    <div class="flex">
                        <div class="inputBox">
                            <label for="">Exp Year:</label>
                            <select name="" id="">
                                <option value="">Choose Year</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                            </select>
                        </div>

                        <div class="inputBox">
                            <label for="cvv">CVV</label>
                            <input type="number" id="cvv" 
                                   placeholder="1234" required>
                        </div>
                    </div>

                </div>

            </div>

            <input type="submit" value="Proceed to Checkout" 
                   class="submit_btn">
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
    
    <script src="../php/javascript.js"></script>

    <script src="../php/item.js"></script>
    
</body>

</html>
