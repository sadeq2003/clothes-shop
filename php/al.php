<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../logos/logoheader.png">
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            font-family: 'Roboto', sans-serif;
            background-color: #f1f2f6;
            color: #333;
            line-height: 1.6;
            background: url('https://images.unsplash.com/photo-1496364299064-93c87154599a?crop=entropy&cs=tinysrgb&fit=max&ixid=MXwyMDg1MnwxfGFsbHwxfHx8fHx8fHx8fHwxNjEyNzg3Mjg&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center fixed;
            background-size: cover;
            font-size: 16px;
        }

        
        header {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 50px 0;
            border-bottom: 4px solid #ffce00;
            margin-top: 80px;
        }

        header h1 {
            font-size: 3rem;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        header p {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: 300;
            color: #f1f2f6;
        }

        .filters {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .filters button {
            background-color: #ffce00;
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            margin: 10px;
            border: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .filters button:hover {
            background-color: #ffa500;
            transform: translateY(-5px);
        }

        .model-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .model-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 100%;
        }

        .model-card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .model-card iframe {
            width: 100%;
            height: 250px;
            border: none;
            border-radius: 15px;
            transition: opacity 0.3s ease;
        }

        .model-card-content {
            padding: 20px;
            background-color: #fff;
            border-top: 2px solid #ffce00;
        }

        .model-title {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .model-description {
            font-size: 1.1rem;
            color: #777;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .price {
            font-size: 1.4rem;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .rating {
            color: #f39c12;
            margin-bottom: 10px;
        }

        .availability {
            font-size: 1.1rem;
            color: green;
            font-weight: 600;
        }

        .availability.out-of-stock {
            color: red;
        }

        .add-to-cart-button {
            background-color: #28a745;
            color: white;
            border-radius: 25px;
            padding: 12px 24px;
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .add-to-cart-button:hover {
            background-color: #218838;
            transform: translateY(-5px);
        }

        /* Modal for Detailed View */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px;
            max-width: 800px;
            width: 100%;
            border-radius: 15px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2.5rem;
            cursor: pointer;
            color: #333;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            text-align: center;
            padding: 30px 0;
            margin-top: 50px;
        }

        footer a {
            color: #ffce00;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            .model-title {
                font-size: 1.3rem;
            }

            .model-description {
                font-size: 1rem;
            }

            footer {
                padding: 15px 0;
            }

            .add-to-cart-button {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
<section id="header">
        <div>
            <a href="../php/index.html"><img src="../logos/logoheader.png" alt="store-logo" class="logo" id="logo"></a>
        </div>
        <div>
        
            <ul id="navbar">
                <li><a href="../php/index.html" >Home</a></li>
                <li><a href="../php/shop.php">Shop</a></li>
                <li><a href="../php/market.php">market</a></li>
                <li><a href="../php/ai.php" class="active">VR</a></li>
                <li><a href="../php/payment.php"><i class="fa-solid fa-cart-plus"></i></a></li>
                <li><a href="../admin/login.php"><i class="fa-solid fa-user"></i></a></li>
                <li ><i  class="fa-solid fa-circle-xmark" id="close"></i></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="payment.php"><i class="fa-solid fa-cart-plus"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
            
        </div>
    </section>
<header>
    <h1>Interactive Fashion Models</h1>
    <p>Explore the latest fashion trends in 3D!</p>
</header>

<!-- Filter Buttons -->
<div class="filters">
    <button onclick="filterModels('jackets')">Jackets</button>
    <button onclick="filterModels('shoes')">Shoes</button>
    <button onclick="filterModels('sportswear')">Sportswear</button>
    <button onclick="filterModels('accessories')">Accessories</button>
</div>

<!-- Models Container -->
<div id="jackets" class="model-grid">
    <!-- Jacket 1 -->
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/361496fd777445878c1165f7fd920354/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Trendy Hoodie</div>
            <div class="model-description">This hoodie is perfect for casual and street fashion.</div>
            <div class="price">$49.99</div>
            <div class="rating">★★★★★</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/361496fd777445878c1165f7fd920354/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Trendy Hoodie</div>
            <div class="model-description">This hoodie is perfect for casual and street fashion.</div>
            <div class="price">$49.99</div>
            <div class="rating">★★★★★</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
    <!-- Jacket 2 -->
    <div class="model-card">
        <iframe title="Hoody" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/7474d1c6916e4d078dafd73027e66f7b/embed"> </iframe>
        <div class="model-card-content">
            <div class="model-title">Leather Jacket</div>
            <div class="model-description">Classic leather jacket for a bold look.</div>
            <div class="price">$32.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
    <div class="model-card">
        <iframe title="Hoody" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/7474d1c6916e4d078dafd73027e66f7b/embed"> </iframe>
        <div class="model-card-content">
            <div class="model-title">Leather Jacket</div>
            <div class="model-description">Classic leather jacket for a bold look.</div>
            <div class="price">$33.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
</div>


<!-- <div class="sketchfab-embed-wrapper"> <iframe title="Pikachu Hoodie Sweatshirt" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/026fd91fc38d47c2b2f27ecdd1d8fb69/embed"> </iframe> <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;"> <a href="https://sketchfab.com/3d-models/pikachu-hoodie-sweatshirt-026fd91fc38d47c2b2f27ecdd1d8fb69?utm_medium=embed&utm_campaign=share-popup&utm_content=026fd91fc38d47c2b2f27ecdd1d8fb69" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> Pikachu Hoodie Sweatshirt </a> by <a href="https://sketchfab.com/Tsubasa_Art?utm_medium=embed&utm_campaign=share-popup&utm_content=026fd91fc38d47c2b2f27ecdd1d8fb69" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;"> Tsubasa Art ツバサ </a> on <a href="https://sketchfab.com?utm_medium=embed&utm_campaign=share-popup&utm_content=026fd91fc38d47c2b2f27ecdd1d8fb69" target="_blank" rel="nofollow" style="font-weight: bold; color: #1CAAD9;">Sketchfab</a></p></div> -->
<div id="shoes" class="model-grid" style="display: none;">
    <!-- Shoes 1 -->
    <div class="model-card">
        <iframe title="Jordan 1 Travis Scott x Fragment" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/7007b36ecf9c4897b532bffabe432162/embed"> </iframe> 
        <div class="model-card-content">
            <div class="model-title">Nike Air Max</div>
            <div class="model-description">Comfortable and stylish sneakers for everyday use.</div>
            <div class="price">$32.99</div>
            <div class="rating">★★★★★</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    <div class="model-card">
        <iframe title="Jordan 1 Travis Scott x Fragment" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/7007b36ecf9c4897b532bffabe432162/embed"> </iframe> 
        <div class="model-card-content">
            <div class="model-title">Nike Air Max</div>
            <div class="model-description">Comfortable and stylish sneakers for everyday use.</div>
            <div class="price">$23.99</div>
            <div class="rating">★★★★★</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    <div class="model-card">
        <iframe title="Jordan 1 Travis Scott x Fragment" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/7007b36ecf9c4897b532bffabe432162/embed"> </iframe> 
        <div class="model-card-content">
            <div class="model-title">Nike Air Max</div>
            <div class="model-description">Comfortable and stylish sneakers for everyday use.</div>
            <div class="price">$43.99</div>
            <div class="rating">★★★★★</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
    <!-- Shoes 2 -->
    <div class="model-card">
        <iframe title="Air Jordan 1" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/a4b434181fbb48008ad460722fd53725/embed"> </iframe> 
        <div class="model-card-content">
            <div class="model-title">Adidas Ultra Boost</div>
            <div class="model-description">High-performance sneakers for running.</div>
            <div class="price">$23.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
</div>

<div id="sportswear" class="model-grid" style="display: none;">
    <!-- Sportswear 1 -->
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/36f8d617550b4b82b31832faee7fa213/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Sporty Tracksuit</div>
            <div class="model-description">A tracksuit that provides comfort for all your workouts.</div>
            <div class="price">$23.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/36f8d617550b4b82b31832faee7fa213/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Sporty Tracksuit</div>
            <div class="model-description">A tracksuit that provides comfort for all your workouts.</div>
            <div class="price">$69.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/36f8d617550b4b82b31832faee7fa213/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Sporty Tracksuit</div>
            <div class="model-description">A tracksuit that provides comfort for all your workouts.</div>
            <div class="price">$23.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
    </div>
    <!-- Sportswear 2 -->
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/566d3e3fc2b94a3a97de4ad2d6f8d012/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Running Shorts</div>
            <div class="model-description">Lightweight and breathable shorts perfect for running.</div>
            <div class="price">$39.99</div>
            <div class="rating">★★★☆☆</div>
            <div class="availability">Out of Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
</div>

<div id="accessories" class="model-grid" style="display: none;">
    <!-- Accessories 1 -->
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/c24d8dfe9f074a68b1edb0847f8dcd64/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Sunglasses</div>
            <div class="model-description">Stylish sunglasses for the summer.</div>
            <div class="price">$29.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/c24d8dfe9f074a68b1edb0847f8dcd64/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Sunglasses</div>
            <div class="model-description">Stylish sunglasses for the summer.</div>
            <div class="price">$29.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/c24d8dfe9f074a68b1edb0847f8dcd64/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Sunglasses</div>
            <div class="model-description">Stylish sunglasses for the summer.</div>
            <div class="price">$29.99</div>
            <div class="rating">★★★★☆</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
    <!-- Accessories 2 -->
    <div class="model-card">
        <iframe src="https://sketchfab.com/models/6d9b1a9b0b4d4e3f9ec72676b7e6f703/embed" allow="autoplay; fullscreen; xr-spatial-tracking"></iframe>
        <div class="model-card-content">
            <div class="model-title">Gold Watch</div>
            <div class="model-description">Elegant gold watch perfect for any occasion.</div>
            <div class="price">$249.99</div>
            <div class="rating">★★★★★</div>
            <div class="availability">In Stock</div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
</div>
<footer class="section-p1">
        <a href="..\php/index.html"><img src="../logos/logoheader.png" alt="store-logo"></a>
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
    function filterModels(category) {
        const allSections = ['jackets', 'shoes', 'sportswear', 'accessories'];
        allSections.forEach(section => {
            document.getElementById(section).style.display = 'none';
        });
        document.getElementById(category).style.display = 'grid';
    }
</script>
<script src="javascript.js"></script>

</body>
</html>
