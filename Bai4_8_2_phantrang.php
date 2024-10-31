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

$san_pham = 2;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $san_pham;

$total_result_sql = "SELECT COUNT(*) as total FROM sua";
$total_result = $conn->query($total_result_sql);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];

$sql = "SELECT sua.ten_sua, sua.trong_luong, sua.don_gia, sua.hinh, sua.tp_dinh_duong, sua.loi_ich, hang_sua.ten_hang_sua 
        FROM sua 
        JOIN hang_sua ON sua.ma_hang_sua = hang_sua.ma_hang_sua 
        LIMIT $offset, $san_pham";
$ketqua = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Chi Tiết Các Loại Sữa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .tieude {
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
            background-color: #f9f9f9;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 3px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2d6d6;
        }
        .anh{
            width:100px;
        }
        .product-image {
            width: 100px; 
            height: 100px;
            object-fit: cover;
        }
        .pagination {
            text-align: center;
            margin: 20px 0;
        }
        .pagination a {
            color: blue;
            padding: 5px 10px;
            border: 1px solid black;
            margin: 0 5px;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 style="color:red; text-align:center">Thông Tin Chi Tiết Các Loại Sữa</h2>
    
    <?php
    if ($ketqua->num_rows > 0) {
        echo '<table>';
        
        while ($dong = $ketqua->fetch_assoc()) {
            ?>
            <tr> <td class="tieude" colspan='2'><?php echo $dong['ten_sua']; ?> - <?php echo $dong['ten_hang_sua']; ?></td>
            </tr>
            <tr>
               <td class="anh"><img src="<?php echo $dong['hinh']; ?>" alt="<?php echo $dong['ten_sua']; ?>" class="product-image"></td>
               <td><?php echo $dong['tp_dinh_duong']; ?><br>
                <?php echo $dong['loi_ich']; ?><br>
                <?php echo $dong['trong_luong']; ?> g<br>
                <?php echo number_format($dong['don_gia'], 0, ',', '.'); ?> VNĐ</td>
            </tr>
            <?php
        }
        echo '</table>';
    } else {
        echo "<p>Không tìm thấy sản phẩm.</p>";
    }
    ?>
    
    <div class="pagination">
        <?php
        $total_pages = ceil($total_products / $san_pham);
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
        ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>