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
            margin: 20px;
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
            margin-top: 20px; 
        }
        th, td {
            border: 1px solid black; 
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; 
        }
        .image-cell {
            width: 250px; 
            text-align: center; 
        }
        .image-cell img {
            width: 100px; 
            height: auto; 
        }
        .info {
            font-size: 18px; 
        }
    </style>
</head>
<body>
    
    <table>
        <tr>
            <td class="tieude" colspan="2">THÔNG TIN CÁC SẢN PHẨM SỮA</td>
        </tr>
        <?php
        if ($ketqua->num_rows > 0) {
            while ($dong = $ketqua->fetch_assoc()) {
                $duong_dan_hinh = $dong["hinh"];

                if (!file_exists($duong_dan_hinh)) {
                    $duong_dan_hinh = "images/default-image.jpg"; 
                }

                echo "<tr>
                        <td class='image-cell'><img src='" . $duong_dan_hinh . "' alt='" . $dong["ten_sua"] . "'></td>
                        <td class='info'>
                            <strong>" . $dong["ten_sua"] . "</strong><br><br>
                            Nhà Sản Xuất: " . $dong["ma_hang_sua"] . "<br>
                            " . $dong["ma_loai_sua"] . " - " . $dong["trong_luong"] . "g - " . number_format($dong["don_gia"], 0, ',', '.') . " VNĐ<br>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>
    
</body>
</html>

<?php
$conn->close();
?>