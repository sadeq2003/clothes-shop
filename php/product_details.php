<?php
session_start();
include('../shopping/include/connect.php');

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "shopping");
if ($conn->connect_error) die("فشل الاتصال بقاعدة البيانات");

// الحصول على معرّف المنتج من الرابط
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// جلب بيانات المنتج
$stmt = $conn->prepare("SELECT p.*, s.sectionname FROM product p LEFT JOIN section s ON p.prosection = s.id WHERE p.id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if (!$product) die("المنتج غير موجود");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل المنتج</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
         /* ================ CSS Variables ================ */
        :root {
            --primary: #2c3e50;
            --secondary: #e67e22;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* ================ Base Styles ================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
        }

        body {
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        /* ================ Header ================ */
        .main-header {
            background: var(--primary);
            color: white;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
        }
        .header-content a{
            text-decoration: none;
            color: white;


        }
        #navbar{
    display: flex;
    align-items: center;
    list-style: none;
    padding: 0 10px;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;

}

#navbar li a{
    
    font-size: 18px;
    font-weight: 600;
    transition: .3s ease-in-out;
    padding: 0 20px;
    position: relative;
    color: white;
    text-decoration: none;

    
}
 #close{
display: none;
}
#logo{
    width: 160px;
}
#navbar li a:hover,
#navbar li a.active
{
    color: #088178;
}

        /* ================ Filter Section ================ */
        .filter-section {
            background: white;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 1400px;
            border-radius: 15px;
            box-shadow: var(--shadow);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .filter-group {
            position: relative;
        }

        .filter-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }

        /* ================ Product Grid ================ */
        .product-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
            position: relative;

        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        /* ================ Product Card ================ */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            position: relative;
            box-shadow: var(--shadow);
            height: 30em;
        }
        .product-details {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .product-gallery img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-info {
            padding: 1rem;
        }

        .detail-item {
            margin: 1rem 0;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .button {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
<header class="main-header">
        <div class="header-content">
            <a href="../php/index.html">
                <h1>المتجر الإلكتروني</h1> 
            </a>   
    <ul id="navbar">
        <li><a href="../php/index.html" >Home</a></li>
        <li><a href="../php/shop.php">Shop</a></li>
        <li><a href="../php/market.php" class="active"></>market</a></li>
        <li><a href="../php/al.php">VR</a></li>
        <li><a href="../php/payment.php"><i class="fa-solid fa-cart-plus"></i></a></li>
        <li><a href="../admin/login.php" ><i class="fa-solid fa-user" ></i></a></li>
        <li ><i  class="fa-solid fa-circle-xmark" id="close"></i></li>
    </ul>
            <!-- <form method="GET" class="filter-group" style="flex-grow: 1; max-width: 400px;">
                <input type="text" name="search" placeholder="بحث عن منتج..." 
                       class="filter-input" value="<?= htmlspecialchars($search_query) ?>">
            </form> -->
    </header>
    <div class="product-details">
        <div class="detail-grid">
            <div class="product-gallery">
                <img src="../shopping/include/imgupload/<?= htmlspecialchars($product['proimg']) ?>" 
                     alt="<?= htmlspecialchars($product['proname']) ?>">
            </div>
            
            <div class="product-info">
                <h1><?= htmlspecialchars($product['proname']) ?></h1>

                <div class="detail-item">
                    <h3>السعر: <span>$<?= number_format($product['proprice'] ?? 0, 2) ?></span></h3>
                </div>

                <div class="detail-item">
                    <h3>القسم: <span><?= htmlspecialchars($product['prosection'] ?? 'غير محدد') ?></span></h3>
                </div>

                <div class="detail-item">
                    <h3>الوصف:</h3>
                    <p><?= nl2br(htmlspecialchars($product['prodesc'])) ?></p>
                </div>

                <form action="../php/payment.php" method="post" style="margin-top: 2rem;">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                    <input type="hidden" name="proname" value="<?= htmlspecialchars($product['proname']) ?>">
                    <input type="hidden" name="prosize" value="<?= htmlspecialchars($product['prosize'] ?? 'حجم غير محدد') ?>">
                    <input type="hidden" name="proprice" value="<?= htmlspecialchars($product['proprice']) ?>">
                    <input type="hidden" name="proimg" value="<?= htmlspecialchars($product['proimg']) ?>">
                    <button type="submit" name="add_to_cart" class="button">
                        <i class="fas fa-shopping-cart"></i> أضف إلى السلة
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
