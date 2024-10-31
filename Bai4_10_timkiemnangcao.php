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


$ma_loai_sua = isset($_POST['loai_sua']) ? $_POST['loai_sua'] : '';
$hang_sua = isset($_POST['hang_sua']) ? $_POST['hang_sua'] : '';
$ten_sua = isset($_POST['ten_sua']) ? $_POST['ten_sua'] : '';


$loai_sua_sql = "SELECT DISTINCT ma_loai_sua FROM sua"; 
$loai_sua_result = $conn->query($loai_sua_sql);


$hang_sua_sql = "SELECT DISTINCT ten_hang_sua FROM hang_sua";
$hang_sua_result = $conn->query($hang_sua_sql);

$sql = "SELECT sua.ten_sua, sua.trong_luong, sua.don_gia, sua.hinh, sua.tp_dinh_duong, sua.loi_ich, hang_sua.ten_hang_sua 
        FROM sua 
        JOIN hang_sua ON sua.ma_hang_sua = hang_sua.ma_hang_sua 
        WHERE (sua.ten_sua LIKE ? OR ? = '') 
        AND (hang_sua.ten_hang_sua = ? OR ? = '') 
        AND (sua.ma_loai_sua = ? OR ? = '')";

$stmt = $conn->prepare($sql);
$search_term = '%' . $ten_sua . '%';
$stmt->bind_param("ssssss", $search_term, $ten_sua, $hang_sua, $hang_sua, $ma_loai_sua, $ma_loai_sua); 
$stmt->execute();
$result = $stmt->get_result();
$total_products = $result->num_rows;
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
        .container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid pink;
            background-color: #f9f9f9;
        }
        .form {
            text-align: center; 
            margin: 0; 
        }
        .tieude {
            text-align: center;
            color: #ff1493;
            font-weight: bold;
            font-size: 24px;
            padding: 10px;
            margin-top: -10px;
            background-color: moccasin;
        }
        .tieude2 {
            text-align: center;
            color: orange;
            font-weight: bold;
            font-size: 20px;
            padding: 10px;
            margin-top: -10px;
            background-color: moccasin;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 3px solid brown;
        }
        th, td {
            border: 2px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: moccasin;
        }
        .product-image {
            max-width: 100px; 
            height: auto; 
        }
        label {
            display: inline-block; 
            margin: 10px 0; 
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="tieude">TÌM KIẾM THÔNG TIN SỮA</h2>
    <div class="form">
        <form method="POST" action="">
            <label for="loai_sua">Loại sữa:</label>
            <select name="loai_sua" id="loai_sua">
                <option value="">Tất cả</option>
                <?php while ($row = $loai_sua_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['ma_loai_sua']; ?>"><?php echo $row['ma_loai_sua']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="hang_sua">Hãng sữa:</label>
            <select name="hang_sua" id="hang_sua">
                <option value="">Tất cả</option>
                <?php while ($row = $hang_sua_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['ten_hang_sua']; ?>"><?php echo $row['ten_hang_sua']; ?></option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="ten_sua">Tên sữa:</label>
            <input type="text" name="ten_sua" id="ten_sua" value="<?php echo htmlspecialchars($ten_sua); ?>">

            <button type="submit">Tìm kiếm</button>
        </form>
    </div>
    <h3 style="margin-bottom:-15px;padding:10px;text-align:center;background-color:moccasin">Có <?php echo $total_products; ?> sản phẩm được tìm thấy</h3>

    <?php if ($total_products > 0): ?>
        <table>
            <?php while ($dong = $result->fetch_assoc()): ?>
                <tr>
                    <td class="tieude2" colspan="2"><?php echo $dong['ten_sua']; ?> - <?php echo $dong['ten_hang_sua']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <img src="<?php echo $dong['hinh']; ?>" alt="<?php echo $dong['ten_sua']; ?>" class="product-image">
                    </td>
                    <td>
                        <p><strong><em>Thành phần dinh dưỡng:</em></strong> <?php echo $dong['tp_dinh_duong']; ?></p>
                        <p><strong><em>Lợi ích:</em></strong> <?php echo $dong['loi_ich']; ?></p>
                        <p><strong><em>Trọng lượng:</em></strong> <?php echo $dong['trong_luong']; ?> g - 
                        <strong><em>Đơn giá:</em></strong> <?php echo number_format($dong['don_gia'], 0, ',', '.'); ?> VNĐ</p>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Không tìm thấy sản phẩm này.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$conn->close();
?>