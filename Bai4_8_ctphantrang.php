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
            border: 3px solid red;
            background-color: #f9f9f9;
        }
        .product-info {
            display: flex;
            margin-bottom: -5px;
            align-items: stretch;
        }
        .product-info img {
            width: auto;
            height: 200px;  
            object-fit: cover;
            border: 1px solid;
        }
        .product-details {
            flex-grow: 1;
            padding: 10px;
            height: 180px;
            width: auto;
            border: 1px solid;
        }
        .product-details strong {
            color: black;
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
    <?php
    if ($ketqua->num_rows > 0) {
        while ($dong = $ketqua->fetch_assoc()) {
            ?>
            <h3 class="tieude"><?php echo $dong['ten_sua']; ?> - <?php echo $dong['ten_hang_sua']; ?></h3>
            <div class="product-info">
                <div>
                    <img src="<?php echo $dong['hinh']; ?>" alt="<?php echo $dong['ten_sua']; ?>">
                </div>
                <div class="product-details">
                    <p><strong>Thành phần dinh dưỡng:</strong> <?php echo $dong['tp_dinh_duong']; ?></p>
                    <p><strong>Lợi ích:</strong> <?php echo $dong['loi_ich']; ?></p>
                    <p style="text-align:right;"><strong>Trọng lượng:</strong> <?php echo $dong['trong_luong']; ?>g - <strong>Đơn giá:</strong> <?php echo number_format($dong['don_gia'], 0, ',', '.'); ?> VNĐ</p>
                </div>
            </div>
            <?php
        }
    } else {
        echo "Không tìm thấy sản phẩm.";
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