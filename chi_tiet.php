<?php
$servername = "127.0.0.1";  
$tendangnhap = "root";         
$matkhau = "";             
$tenbang = "ql_ban_sua";     

$conn = new mysqli($servername, $tendangnhap, $matkhau, $tenbang);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
mysqli_set_charset($conn ,"utf8");
if (isset($_GET['ma_sua'])) {
    $ma_sua = $_GET['ma_sua'];

    $sql = "SELECT sua.ten_sua, sua.trong_luong, sua.don_gia, sua.hinh, sua.tp_dinh_duong, sua.loi_ich, hang_sua.ten_hang_sua 
            FROM sua 
            JOIN hang_sua ON sua.ma_hang_sua = hang_sua.ma_hang_sua 
            WHERE ma_sua = '$ma_sua'";
    $ketqua = $conn->query($sql);

    if ($ketqua->num_rows > 0) {
        $dong = $ketqua->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit;
    }
} else {
    echo "Không có mã sản phẩm.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta  charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
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
            padding:20px;
            margin:0;
            border: 1px solid black;
        }
        .container {
            width: 60%;
            margin: 0 auto;
            border: 3px solid red;
            padding: 2px;
            background-color: #f9f9f9;
        }
        .product-info {
            display: flex;
            border: 1px solid black; 
            padding: 2px;
        }
        .product-info img {
            width: auto;
            height: 197px;
            border: 1px solid black;
            margin-right: 2px; 
            
        }
        .product-details {
            flex-grow: 1;
            border: 1px solid black;
            height:193px;
            padding:2px;
            color:purple;
        }
        .product-details strong{
            color:black;
        }
        .back-link {
            text-align: right;
            border:1px solid;
            width:97%;
            
        }
        a {
            text-decoration: none;
            color: blue;
            padding-right: 5px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

   <div class="container">
        <h2 class="tieude"><?php echo $dong['ten_sua']; ?> - <?php echo $dong['ten_hang_sua']; ?></h2>
  
        <div class="product-info">
            <div>
                <img src="<?php echo $dong['hinh']; ?>" alt="<?php echo $dong['ten_sua']; ?>">
                <div class="back-link">
                    <a href="Bai4_7_trang1.php">Quay về</a>
                </div>
            </div>
            <div class="product-details">
                <p><i><strong> &nbsp Thành phần dinh dưỡng:</strong></i> <?php echo $dong['tp_dinh_duong']; ?></p>
                <p><i><strong> &nbsp Lợi ích:</strong></i> <?php echo $dong['loi_ich']; ?></p>
                <p style="text-align:right; margin-top:100px;padding-right:5px"><strong>Trọng lượng:</strong> <?php echo $dong['trong_luong']; ?>g - <strong>Đơn giá:</strong> <?php echo number_format($dong['don_gia'], 0, ',', '.'); ?> VNĐ</p>
                
            </div>

        </div>
        

        
    </div>
    
</body>
</html>

<?php
$conn->close();
?>