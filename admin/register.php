<?php
include('../shopping/include/connect.php')

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>js</title>
    <link rel="stylesheet" href="css.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <section class="hero">
           <form action="" method="POST">
            <div class="contian">
                <div class="input">
                    <h1>
                        Register
                    </h1>
                    <div class="input-box">
                        <input type="text" placeholder="user name">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="email" placeholder="email address ">
                        <i class="fa-solid fa-e"></i>
                    </div>
                    <div class="input-box"> 
                        <input type="password" placeholder="password">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                </div>
                <button>
                    signup
                </button>
                <div class="register">
                    <p>i have on account? <a href="login.php">login</a></p>
                </div>
            </div>
           </form>
    </section>
    <script src="js.js"></script>
</body>
</html>

