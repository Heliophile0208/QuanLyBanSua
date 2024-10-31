<?php
$servername = "127.0.0.1";  
$tendangnhap = "root";         
$matkhau = "";             
$tenbang = "ql_ban_sua";     

$conn = new mysqli($servername, $tendangnhap, $matkhau, $tenbang);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");

$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

$sql = "SELECT sua.ten_sua, sua.trong_luong, sua.don_gia, sua.hinh, sua.tp_dinh_duong, sua.loi_ich, hang_sua.ten_hang_sua 
        FROM sua 
        JOIN hang_sua ON sua.ma_hang_sua = hang_sua.ma_hang_sua 
        WHERE sua.ten_sua LIKE '%$search_query%'";
$ketqua = $conn->query($sql);
$total_products = $ketqua->num_rows;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Thông Tin Sữa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .tieude {
            text-align: center;
            color: #FF1493;
            background-color: lightpink;
            font-weight: bold;
            font-size: 24px;
            padding: 10px;
            margin: 0;
        
        }
       .tieude2 {
               text-align: center;
               color: orange;
               background-color: #f2d6d6;
               font-weight: bold;
               font-size: 24px;
               padding: 10px;
               margin: 0;
               border: 1px solid black;
           }
        
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: lightyellow;
            padding: 10px;
        }
        .search-container {
            text-align: center;
            margin-top: 5px;
            background-color:lightpink;
            padding:5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border:3px solid orange;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2d6d6;
        }
        .product-image {
            width: 100px; 
            height: 100px; 
            object-fit: cover;
        }
        .ketqua{
            text-align:center;
            font-weight:bold;
            font-size:24px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="tieude">TÌM KIẾM THÔNG TIN SỮA</h2>

    <div class="search-container">
        <form method="POST" action="">
            <input type="text" name="search" placeholder="Nhập tên sữa..." value="<?php echo htmlspecialchars($search_query); ?>" required>
            <input type="submit" value="Tìm kiếm">
        </form>
    </div>
    <div class="ketqua">
    <?php
    if ($total_products > 0) {
        echo "<br>Có $total_products sản phẩm được tìm thấy";
        echo '</div>';
        echo '<table>';
          while ($dong = $ketqua->fetch_assoc()) {
            ?>
            <tr><td colspan='2' class="tieude2"><?php echo $dong['ten_sua']; ?> - <?php echo $dong['ten_hang_sua']; ?></td>
            </tr>
            <tr>
                <td><img src="<?php echo $dong['hinh']; ?>" alt="<?php echo $dong['ten_sua']; ?>" class="product-image"></td>
                <td>  <?php echo $dong['tp_dinh_duong']; ?><br>
                <?php echo $dong['loi_ich']; ?><br>
                <?php echo $dong['trong_luong']; ?> 
                <p><?php echo number_format($dong['don_gia'], 0, ',', '.'); ?> VNĐ</p></td>
            </tr>
            <?php
        }
        echo '</table>';
    } else {
        echo "<p>Không tìm thấy sản phẩm này.</p>";
    }
    ?>
</div>

</body>
</html>

<?php
$conn->close();
?>