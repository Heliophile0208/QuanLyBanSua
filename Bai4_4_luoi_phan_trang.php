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
$gioihan = 5; 
$trang_hien_tai = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$hangbatdau = ($trang_hien_tai - 1) * $gioihan;

$demtongdong = "SELECT COUNT(*) AS tong FROM sua";
$ketqua_tong = $conn->query($demtongdong);
$dong_tong = $ketqua_tong->fetch_assoc();
$dong_du_lieu = $dong_tong['tong'];
$so_trang = ceil($dong_du_lieu / $gioihan);

$sql = "SELECT * FROM sua LIMIT $hangbatdau, $gioihan";
$ketqua = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sản phẩm sữa</title>
    <style>
        body {
            font-family: Arial, sans-serif; 
        }
        .container {
            border: 2px solid #003366; 
            padding: 20px;             
            margin: 20px;              
            border-radius: 10px;       
        }
        h2 {
            text-align: center; 
        }
        table {
            width: 100%;
            border-collapse: collapse;       
        }
        th, td {
            border: 1px solid black; 
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; 
        }
        tr:nth-child(even) {
            background-color: #FFA500; 
        }
        .phantrang {
            text-align: center; 
            margin-top: 20px; 
        }
        .phantrang a {
            margin: 0 5px; 
            padding: 8px 12px; 
            border: 1px solid #003366; 
            text-decoration: none; 
            color: #003366; 
        }
        .phantrang a.hoatdong {
            background-color: #003366; 
            color: white; 
        }
        .phantrang a.an {
            pointer-events: none; 
            color: grey; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông Tin Sản Phẩm Sữa</h2>
        <table>
            <tr>
                <th>STT</th>
                <th>Mã Sữa</th>
                <th>Tên Sữa</th>
                <th>Mã Hãng Sữa</th>
                <th>Mã Loại Sữa</th>
                <th>Trọng Lượng</th>
                <th>Đơn Giá</th>
                <th>TP Dinh Dưỡng</th>
                <th>Lợi Ích</th>
                <th>Hình</th>
            </tr>

            <?php
            if ($ketqua->num_rows > 0) {
                $stt = $hangbatdau + 1; 
                while($dong = $ketqua->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $stt++ . "</td>
                            <td>" . $dong["ma_sua"] . "</td>
                            <td>" . $dong["ten_sua"] . "</td>
                            <td>" . $dong["ma_hang_sua"] . "</td>
                            <td>" . $dong["ma_loai_sua"] . "</td>
                            <td>" . $dong["trong_luong"] . "</td>
                            <td>" . $dong["don_gia"] . "</td>
                            <td>" . $dong["tp_dinh_duong"] . "</td>
                            <td>" . $dong["loi_ich"] . "</td>
                            <td><img src='" . $dong["hinh"] . "' alt='" . $dong["ten_sua"] . "' style='width:50px;height:50px;'></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Không có dữ liệu</td></tr>";
            }
            ?>
        </table>
        
        <div class="phantrang">
            <a href="?page=1" <?php if ($trang_hien_tai == 1) echo 'class="an"'; ?>><<</a>
            <a href="?page=<?php echo max(1, $trang_hien_tai - 1); ?>" <?php if ($trang_hien_tai == 1) echo 'class="an"'; ?>><</a>

            <?php for ($i = 1; $i <= $so_trang; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $trang_hien_tai) ? 'hoatdong' : ''; ?>" style="text-decoration: underline;"><?php echo $i; ?></a>
            <?php endfor; ?>

            <a href="?page=<?php echo min($so_trang, $trang_hien_tai + 1); ?>" <?php if ($trang_hien_tai == $so_trang) echo 'class="an"'; ?>>></a>
            <a href="?page=<?php echo $so_trang; ?>" <?php if ($trang_hien_tai == $so_trang) echo 'class="an"'; ?>>>></a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>