<?php

use PgSql\Result;

session_start();



include('../shopping/include/connect.php');
?>
<?php
@$proname =$_POST['proname'];
@$proprice =$_POST['proprice'];
@$prosize =$_POST['prosize'];
@$procolor =$_POST['procolor'];
@$prodesc =$_POST['prodesc'];
@$pronamber =$_POST['pronamber'];
@$prosection =$_POST['prosection'];
@$proid =$_POST['proid'];
@$proadd =$_POST['proadd'];
// img start   
@$imgname=$_FILES['proimg']['name'];
@$imgname_Tmp=$_FILES['proimg']['tmp_name'];


// start delete producta

@$id=$_GET['id'];
if(isset($id)){
    $query="DELETE FROM PRODUCT WHERE id='$id'";
    $delete=mysqli_query($conn,$query);
    // if(isset($delete)){
    //     echo '<script> alert("تم الحذف بنجاح.");</script>';
    // }
    // else{
    //     echo '<script> alert("لم يتم الحذف.");</script>';
    // }
}

if(isset($proadd)){
    if(empty($proname)||empty($prodesc)){
      echo '<script> alert("Please add product name and description.");</script>';

    }
    else{
        $proimg=rand(0,200). "_".$imgname;
        move_uploaded_file($imgname_Tmp,"../shopping/include/imgupload//" . $proimg);


        // تحقق من عملية رفع الصورة
       
        
    

$query="INSERT INTO product(proname,proimg,proprice,
procolor,prosize,prodesc,pronamber,prosection) VALUES('$proname','$proimg','$proprice','$procolor','$prosize','$prodesc','$pronamber','$prosection')";

$result=mysqli_query($conn,$query);

if(isset($result)){
    echo'<script> alert ("ثم اضافة المنتج بنجاح");</script>';
}
else{
    echo'<script> alert ("لم يتم اضافة المنتج بنجاح");</script>';
}

}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="logos/logoheader.png">
    
    <title>store shoping</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
     if(!isset($_SESSION['EMAIL']))
     {
        header('location:login.php');
     }
     else
     {

     
    ?>
   
    <?php 
    @$sectionname=$_POST['sectionname'];
    @$addsection=$_POST['sectionadd'];


    if(isset($addsection)){
        if(empty($sectionname))
        {
            echo'<script> alert ("pless add section");</script>';}
        
        elseif($sectionname<50){
            echo'<script> alert ("pless add section less then 50 letter");</script>';

        }
    
    else{
        $query="INSERT INTO section (sectionname) VALUES ('$sectionname')";
        $result=mysqli_query($conn,$query);
        echo'<script> alert ("section added sccssuful");</script>';

    }}
    ?>
    

        <section id="header" style="margin: 0;">

        <div>
            <a href="../php/index.html"><img src="../logos/logoheader.png" alt="store-logo" class="logo" id="logo"></a>
        </div>
        <div>
            
            <ul id="navbar">
                <li><a href="../php/index.html" >Home</a></li>
                <li><a href="../php/shop.php">Shop</a></li>
                <li><a href="#market.html">market</a></li>
                <li><a href="al.php">VR</a></li>
                <li><a href="../php/payment.php"><i class="fa-solid fa-cart-plus"></i></a></li>
                <li><a href="../admin/login.php" class="active"><i class="fa-solid fa-user" ></i></a></li>
                <li ><i  class="fa-solid fa-circle-xmark" id="close"></i></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="../php/payment.html"><i class="fa-solid fa-cart-plus"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
            
        </div>
    </section>

    
    <section id="container">
        <!-- القائمة الجانبية -->
        <div class="sidebar">
            <h2>لوحة تحكم الإدارة</h2>
            <ul>
                <li><a href="../php/index.html"> <i class="fa-solid fa-house"></i> الصفحة الرئيسية</a></li>
                <li><a href="#">
                <i class="fa-solid fa-shirt"></i>صفحة المنتجات</a></li>
                <li><a href="#">
                <i class="fa-solid fa-folder-plus"></i>إضافة منتج</a></li>
                <li><a href="#">
                <i class="fa-solid fa-users"></i>معلومات الأعضاء</a></li>
                <li><a href="#">
                <i class="fa-solid fa-folder-open"></i>طلبات الزبائن</a></li>
                <li><a href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>تسجيل الخروج</a></li>
            </ul>
        </div>

        <!-- المحتوى الرئيسي -->
        <div class="main-content">
            <h1>إضافة منتج جديد</h1>
            <form action="products.php" method="post" enctype="multipart/form-data">
                <input type="text" placeholder="اسم المنتج" name="proname" class="form_input"/>
                <input type="text" placeholder="وصف المنتج" name="prodesc"/>
                <input type="text" placeholder="عدد المنتج المنتج" name="pronamber"/>
                <input type="text" placeholder="حجم المنتج" name="prosize"/>
                <input type="text" placeholder="لون المنتج" name="procolor"/>
                <input type="price" placeholder="سعر المنتج" name="proprice"/>
                <input type="file" placeholder="صورة المنتج" name="proimg"/>
                <select name="prosection" id="prosection">
                <?php
                $query="SELECT * FROM section";
                $result=mysqli_query($conn,$query);
                 while($row=mysqli_fetch_assoc($result)){
                    echo '<option value="' . ($row['sectionname']) . '" name="prosection">' . ($row['sectionname']) . '</option>';
                }
                ?>
                 </select>
                <button type="submit" name="proadd">إضافة المنتج</button>
            </form>
            <table >
                <thead>
                    <tr>
                        <th>الرقم التسلسلي</th>
                        <th>اسم المنتج</th>
                        <th>وصف المنتج</th>
                        <th>حجم المنتج</th>
                        <th>لون المنتج</th>
                        <th>سعر المنتج</th>
                        <th> عدد المنتج</th>
                        <th> قسم المنتج</th>
                        <th>صورة المنتج</th>
                        <th>حذف المنتج</th>
                        <td>تعديل المنتج</td>
                     </tr>
                </thead>
                <!-- <tbody>
                        <td>الرقم التسلسلي</td>
                        <td>اسم المنتج</td>
                        <td>وصف المنتج</td>
                        <td>حجم المنتج</td>
                        <td>لون المنتج</td>
                        <td>سعر المنتج</td>
                        <td>عدد المنتج</td>
                        <td>صورة المنتج</td>
                        <td>
                        <button type="submit" class="delete-btn">حذف القسم</button>
                        </a></td>
                        <td>
                        <button type="submit" class="delete-btn" id="update-btn">تعديل القسم</button>
                        </a></td>
                        </td>
                      
                </tbody> -->
                <?php
                $query="SELECT * FROM product";
                $result=mysqli_query($conn,$query);
                while($row=mysqli_fetch_assoc($result)){

                
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['proname']; ?></td>
                        <td><?php echo $row['prodesc']; ?></td>
                        <td><?php echo $row['prosize']; ?></td>
                        <td><?php echo $row['procolor']; ?></td>
                        <td><?php echo $row['proprice']; ?></td>
                        <td><?php echo $row['pronamber']; ?></td>
                        <td><?php echo $row['prosection']; ?></td>
                        <td><?php echo $row['proimg']; ?></td>
                        <td>
                            <a href="products.php?id=<?php echo $row['id']?>">
                             <button class="delete-btn" >حذف المنتج</button>
                          
                            </a>
                        </td>
                           
                        <td>
                        <button class="delete-btn" id="update-btn">تعديل المنتج</button>
                    
                        </td>
                    </tr>
                    
                </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </section>

    <?php 
     }
     ?>
<script src="../php/javascript.js"></script>
</body>
</html>