<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "shopping");
if ($conn->connect_error) die("فشل الاتصال بقاعدة البيانات");

// الحصول على معرّف المنتج من الرابط
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// جلب بيانات المنتج
$stmt = $conn->prepare("SELECT 
    p.*, 
    s.sectionname 
    FROM product p
    LEFT JOIN section s ON p.prosection = s.id
    WHERE p.id = ?");
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
    </style>
</head>
<body>
    <div class="product-details">
        <div class="detail-grid">
            <div class="product-gallery">
                <img src="../shopping/include/imgupload/<?= htmlspecialchars($product['proimg']) ?>" 
                     alt="<?= htmlspecialchars($product['proname']) ?>">
            </div>
            
            <div class="product-info">
                <h1><?= htmlspecialchars($product['proname']) ?></h1>
                
                <div class="detail-item">
                    <h3>السعر: <span>$<?= number_format($product['proprice'], 2) ?></span></h3>
                </div>

                <div class="detail-item">
                    <h3>القسم: <span><?= htmlspecialchars($product['sectionname']) ?></span></h3>
                </div>

                <div class="detail-item">
                    <h3>الوصف:</h3>
                    <p><?= nl2br(htmlspecialchars($product['prodesc'])) ?></p>
                </div>

                <form action="add_to_cart.php" method="post" style="margin-top: 2rem;">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem;">
                        <i class="fas fa-cart-plus"></i> إضافة إلى السلة
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>