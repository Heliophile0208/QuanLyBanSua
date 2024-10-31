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
$sql = "SELECT * FROM sua";
$ketqua = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm Sữa</title>
    <style>
        body {
            font-family: Arial, sans-serif; 
        }
        .tieude {
            text-align: center; 
            color: red; 
            background-color: #f2d6d6; 
            font-weight: bold;
            font-size: 24px;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;       
            margin-top: 0px; 
            background-color: lightgray;
        }
        .product-table {
            width: 100%; 
            border: 1px solid black; 
            text-align: center; 
            border-collapse: collapse; 
            table-layout: fixed; 
        }
        .product-table img {
            width: auto; 
            height: 80px;
            padding-bottom:10px 
        }

        td {
            padding: 0; 
            width: 20%;
            height: 80px; 
        }
        .info {
            font-size: 16px; 
            padding: 5px 0; 
        }
    </style>
</head>
<body>
    
    <div class="tieude">THÔNG TIN CÁC SẢN PHẨM</div>
    <table>
        <tr>
        <?php
        if ($ketqua->num_rows > 0) {
            $count = 0;
            while ($dong = $ketqua->fetch_assoc()) {
                if ($count > 0 && $count % 5 == 0) {
                    echo "</tr><tr>"; 
                }

                $duong_dan_hinh = $dong["hinh"];
                if (!file_exists($duong_dan_hinh)) {
                    $duong_dan_hinh = "images/default-image.jpg";
                }

                echo "<td>
                        <table class='product-table'>
                            <tr>
                                <td class='info'><strong>" . $dong["ten_sua"] . "</strong><br>" . $dong["trong_luong"] . "g - " . number_format($dong["don_gia"], 0, ',', '.') . " VNĐ</td>
                            </tr>
                            <tr>
                                <td><img src='" . $duong_dan_hinh . "' alt='" . $dong["ten_sua"] . "'></td>
                            </tr>
                        </table>
                    </td>";
                $count++;
            }
            echo "</tr>";
        } else {
            echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>
    
</body>
</html>

<?php
$conn->close();
?>