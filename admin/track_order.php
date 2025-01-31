<?php
session_start();

// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root"; // اسم المستخدم
$password = ""; // كلمة المرور
$dbname = "shopping"; // اسم قاعدة البيانات

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// معالجة طلب تتبع الطلب
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['orderNumber'])) {
    $orderNumber = $_GET['orderNumber'];

    // استعلام SQL للبحث عن الطلب
    $sql = "SELECT * FROM orders WHERE order_number = '$orderNumber'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = [
            'status' => 'success',
            'order' => $row
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'لم يتم العثور على الطلب.'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="..\css\style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="icon" href="logos/logoheader.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
    /* ✅ تحسين تصميم الصفحة بالكامل */
body {
    font-family: 'Tajawal', sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    flex-direction: column;
}

/* ✅ تحسين تصميم الـ Sidebar */
.sidebar {
    width: 250px;
    height: 100vh;
    background: linear-gradient(135deg, #28a745, #218838);
    padding-top: 20px;
    position: fixed;
    left: 0;
    top: 0;
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.sidebar h2 {
    color: white;
    text-align: center;
    margin-bottom: 20px;
    font-size: 22px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    padding: 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    display: flex;
    align-items: center;
    transition: background 0.3s ease;
}

.sidebar ul li a i {
    margin-right: 10px;
}

.sidebar ul li:hover {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 6px;
}

/* ✅ زر القائمة الجانبية (للجوال) */
.menu-btn {
    display: none;
    position: fixed;
    top: 15px;
    left: 15px;
    background: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 20px;
    cursor: pointer;
    border-radius: 6px;
    z-index: 1000;
}

/* ✅ تحسين التصميم على الشاشات الصغيرة */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }
    .sidebar.show {
        transform: translateX(0);
    }
    .menu-btn {
        display: block;
    }
}

/* ✅ تحسين تصميم الحاوية الرئيسية */
.container {
    background-color: #fff;
    padding: 100px;
    margin-top: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 600px;
    width: 100%;
    margin-left: 270px; /* حتى لا يتداخل مع الـ Sidebar */
}

h1 {
    margin-bottom: 20px;
    color: #333;
    font-size: 28px;
}

label {
    display: block;
    margin-bottom: 10px;
    color: #555;
    font-size: 18px;
}

input {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
}

button {
    padding: 12px 24px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #218838;
}

#result {
    margin-top: 20px;
    font-size: 18px;
    text-align: left;
}

/* ✅ إصلاح مشكلة الخريطة */
#map {
    height: 300px;
    width: 100%;
    margin-top: 20px;
    border-radius: 8px;
    border: 1px solid #ddd;
    display: none; /* لن تظهر حتى يتم تحميل الخريطة */
}

.order-details {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.order-details p {
    margin: 10px 0;
    color: #555;
}

.order-details strong {
    color: #333;
}

    </style>
</head>

<body>
<div class="sidebar">
            <h2>لوحة تحكم الإدارة</h2>
            <ul>
                <li><a href="../php/index.html"> <i class="fa-solid fa-house"></i> الصفحة الرئيسية</a></li>
                <li><a href="admin.php"> <i class="fa-solid fa-user"></i> صفحة الادمن</a></li>
                <li><a href="products.php">
                <i class="fa-solid fa-shirt"></i>صفحة المنتجات</a></li>
                <li><a href="#">
                <i class="fa-solid fa-folder-plus"></i>إضافة منتج</a></li>
                <li><a href="#">
                <i class="fa-solid fa-users"></i>معلومات الأعضاء</a></li>
                <li><a href="track_order.php">
                <i class="fa-solid fa-folder-open"></i>طلبات الزبائن</a></li>
                <li><a href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>تسجيل الخروج</a></li>
            </ul>
        </div>
    <!-- <section id="header">
        <div>
            <a href="index.html"><img src="../logos/logoheader.png" alt="store-logo" class="logo" id="logo"></a>
        </div>
        <div>
            <ul id="navbar">
                <li><a href="../php/index.html" >Home</a></li>
                <li><a href="../php/shop.php" >Shop</a></li>
                <li><a href="#market.html">market</a></li>
                <li><a href="al.php">VR</a></li>
                <li><a href="../php/payment.php" class="active"><i class="fa-solid fa-cart-plus"></i></a></li>
                <li><a href="../admin/login.php"><i class="fa-solid fa-user"></i></a></li>
                <li><i  class="fa-solid fa-circle-xmark" id="close"></i></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="../php/payment.html"><i class="fa-solid fa-cart-plus"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section> -->
    
    <div class="container">
        <h1>تتبع حالة الطلب</h1>
        <form id="trackOrderForm">
            <label for="orderNumber">رقم الطلب:</label>
            <input type="text" id="orderNumber" name="orderNumber" required>
            <button type="submit">تتبع</button>
        </form>
        <div id="result"></div>
        <div id="map"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.getElementById('trackOrderForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const orderNumber = document.getElementById('orderNumber').value;
            const resultDiv = document.getElementById('result');

            fetch(`track_order.php?orderNumber=${orderNumber}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        resultDiv.innerHTML = `
                            <div class="order-details">
                                <p><strong>حالة الطلب:</strong> ${data.order.status}</p>
                                <p><strong>تاريخ الطلب:</strong> ${data.order.created_at}</p>
                                <p><strong>تاريخ الشحن المتوقع:</strong> 2023-12-15</p>
                                <p><strong>تفاصيل المنتجات:</strong></p>
                                <ul>
                                    <li>منتج 1 - 50$</li>
                                    <li>منتج 2 - 30$</li>
                                </ul>
                            </div>
                        `;
                        initMap(36.3350, 43.1189); // إحداثيات الموصل كمثال
                    } else {
                        resultDiv.innerHTML = `<p style="color: red;">${data.message}</p>`;
                    }
                })
                .catch(error => {
                    resultDiv.innerHTML = `<p style="color: red;">حدث خطأ أثناء الاتصال بالخادم.</p>`;
                });
        });

        function initMap(lat, lng) {
            try {
                const mapDiv = document.getElementById("map");
                if (!mapDiv) return;

                const map = L.map('map').setView([lat, lng], 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([lat, lng]).addTo(map)
                    .bindPopup('موقع الطلب')
                    .openPopup();

                mapDiv.style.display = "block"; // إظهار الخريطة بعد التحميل
            } catch (error) {
                console.error("Error loading map:", error);
                document.getElementById("map").innerHTML = "<p>تعذر تحميل الخريطة. يرجى المحاولة لاحقًا.</p>";
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.querySelector(".sidebar");
            const menuBtn = document.createElement("button");
            menuBtn.classList.add("menu-btn");
            menuBtn.innerHTML = "☰";
            document.body.appendChild(menuBtn);

            menuBtn.addEventListener("click", function () {
                sidebar.classList.toggle("show");
            });

            document.addEventListener("click", function (event) {
                if (!sidebar.contains(event.target) && !menuBtn.contains(event.target)) {
                    sidebar.classList.remove("show");
                }
            });
        });
    </script>
</body>
</html>