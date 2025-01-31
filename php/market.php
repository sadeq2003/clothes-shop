<?php
// الاتصال الآمن بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping";

// إنشاء اتصال مع التحقق من الأخطاء
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("<div class='error'>فشل الاتصال بقاعدة البيانات: " . $conn->connect_error . "</div>");
}

// تعيين مجموعة الأحرف لضبط اللغة العربية
$conn->set_charset("utf8mb4");

// ================ معالجة معاملات التصفية ================
$allowed_orders = [
    'price_asc' => 'proprice ASC',
    'price_desc' => 'proprice DESC',
    'newest' => 'id DESC',
    'oldest' => 'id ASC'
];

// الحصول على القيم من النموذج مع التنظيف
$selected_section = isset($_GET['section']) ? intval($_GET['section']) : 0;
$selected_order = isset($_GET['order']) && isset($allowed_orders[$_GET['order']]) ? 
                $allowed_orders[$_GET['order']] : 
                $allowed_orders['newest'];
$search_query = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// ================ استعلام الأقسام ================
$sections = [];
$section_stmt = $conn->prepare("SELECT id, sectionname FROM section");
if ($section_stmt->execute()) {
    $section_result = $section_stmt->get_result();
    while ($row = $section_result->fetch_assoc()) {
        $sections[$row['id']] = $row['sectionname'];
    }
}
$section_stmt->close();

// ================ استعلام المنتجات مع التصفية ================
$products = [];
$where_clauses = [];
$params = [];
$types = '';

// تصفية حسب القسم
if ($selected_section > 0) {
    $where_clauses[] = "prosection = ?";
    $params[] = $selected_section;
    $types .= 'i';
}

// تصفية حسب البحث
if (!empty($search_query)) {
    $where_clauses[] = "(proname LIKE ? OR prodesc LIKE ?)";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
    $types .= 'ss';
}

// بناء الاستعلام الديناميكي
$sql = "SELECT * FROM product";
if (!empty($where_clauses)) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}
$sql .= " ORDER BY $selected_order LIMIT 100";

// إعداد وتنفيذ الاستعلام
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    die("<div class='error'>خطأ في جلب البيانات: " . $stmt->error . "</div>");
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المتجر الإلكتروني المتكامل</title>
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

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .product-image-container {
            overflow: hidden;
            height: 350px;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
            position: relative;

        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-badge {
            top: -15px;
            right: 15px;
            background: var(--secondary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;

        }

        /* .product-title {
            font-size: 1.4rem;
            margin: 1rem 0;
            cursor: pointer;
            color: var(--primary);
            text-decoration: none;
        } */

        .product-title:hover {
            color: var(--secondary);
        }

        .product-meta {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.4rem;
            color:red;
            font-weight: bold;
            position: absolute;
            right:30px;
            top: 20px;
            text-decoration: underline;

        }

        .product-rating {
            color: #f1c40f;
            font-size: 0.9rem;
        }

        /* ================ Action Buttons ================ */
        .product-actions {
            display: grid;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.8rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--secondary);
            color: white;
        }

        .btn-secondary {
            background: var(--primary);
            color: white;
        }

        .details-button {
            background: var(--primary);
            color: white !important;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .details-button:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        /* ================ Responsive Design ================ */
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                text-align: center;
            }
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
    </style>
   
</head>
<body>
    
<!-- <section id="header" style="margin-bottom: 100px;" >

   <div>
    <a href="../php/index.html"><img src="../logos/logoheader.png" alt="store-logo" class="logo" id="logo"></a>
    </div>
    <div>
    
    <ul id="navbar">
        <li><a href="../php/index.html" >Home</a></li>
        <li><a href="../php/shop.php">Shop</a></li>
        <li><a href="../php/market.php">market</a></li>
        <li><a href="../php/al.php">VR</a></li>
        <li><a href="../php/payment.php"><i class="fa-solid fa-cart-plus"></i></a></li>
        <li><a href="../admin/login.php" class="active"><i class="fa-solid fa-user" class="active"></i></a></li>
        <li ><i  class="fa-solid fa-circle-xmark" id="close"></i></li>
    </ul>
    </div>
    <div id="mobile">
    <a href="../php/payment.php"><i class="fa-solid fa-cart-plus"></i></a>
    <i id="bar" class="fas fa-outdent"></i>
    
    </div>
</section> -->
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
            <form method="GET" class="filter-group" style="flex-grow: 1; max-width: 400px;">
                <input type="text" name="search" placeholder="بحث عن منتج..." 
                       class="filter-input" value="<?= htmlspecialchars($search_query) ?>">
            </form>
    </header>

    <div class="filter-section">
        <form method="GET" class="filter-grid">
            <div class="filter-group">
                <select name="section" class="filter-input">
                    <option value="0">جميع الأقسام</option>
                    <?php foreach ($sections as $id => $name): ?>
                    <option value="<?= $id ?>" <?= $selected_section == $id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($name) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <select name="order" class="filter-input">
                    <?php foreach ($allowed_orders as $key => $value): ?>
                    <option value="<?= $key ?>" <?= $selected_order == $value ? 'selected' : '' ?>>
                        <?= match($key) {
                            'price_asc' => 'السعر: من الأقل للأعلى',
                            'price_desc' => 'السعر: من الأعلى للأقل',
                            'newest' => 'الأحدث أولاً',
                            'oldest' => 'الأقدم أولاً'
                        } ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter"></i> تطبيق الفلتر
            </button>
        </form>
    </div>

    <div class="product-container">
        <div class="product-grid">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <a href="product_details.php?id=<?= $product['id'] ?>" class="product-image-container">
                        <img src="../shopping/include/imgupload/<?= htmlspecialchars($product['proimg']) ?>" 
                             alt="<?= htmlspecialchars($product['proname']) ?>" 
                             class="product-image">
                    </a>
                    
                    <div class="product-info">
                        <!-- <h3 class="product-title">
                            <a href="product_details.php?id=<?= $product['id'] ?>">
                                <?= htmlspecialchars($product['proname']) ?>
                            </a>
                        </h3> -->

                        <div class="product-meta">
                            <span class="product-price">
                                $<?= number_format($product['proprice'], 2) ?>
                            </span>
                        </div>

                        <div class="product-actions">
                            <!-- <form action="add_to_cart.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="proname" value="<?= htmlspecialchars($product['proname']) ?>">
                                <input type="hidden" name="prosize" value="<?= htmlspecialchars($product['prosize'] ?? 'غير محدد') ?>">
                                <input type="hidden" name="proprice" value="<?= $product['proprice'] ?>">
                                <input type="hidden" name="proimg" value="<?= htmlspecialchars($product['proimg']) ?>">
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-cart-plus"></i> إضافة إلى السلة
                                </button>
                            </form> -->

                            <!-- <a href="product_details.php?id=<?= $product['id'] ?>" class="details-button">
                                <i class="fas fa-info-circle"></i> التفاصيل الكاملة
                            </a> -->
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-products">
                    <i class="fas fa-box-open fa-3x"></i>
                    <p>لا توجد منتجات متاحة حسب معايير البحث</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // تفعيل تأثيرات الhover الديناميكية
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
           
     
    </script>
</body>
</html>