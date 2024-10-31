<?php
$servername = "127.0.0.1";  
$username = "root";         
$password = "";             
$database = "ql_ban_sua";     

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");

$ma_loai_sua = isset($_POST['loai_sua']) ? $conn->real_escape_string($_POST['loai_sua']) : '';
$hang_sua = isset($_POST['hang_sua']) ? $conn->real_escape_string($_POST['hang_sua']) : '';
$ten_sua = isset($_POST['ten_sua']) ? $conn->real_escape_string($_POST['ten_sua']) : '';

$loai_sua_result = $conn->query("SELECT DISTINCT ma_loai_sua FROM sua");
$hang_sua_result = $conn->query("SELECT DISTINCT ten_hang_sua FROM hang_sua");

$search_term = '%' . $ten_sua . '%';
$sql = "SELECT sua.ten_sua, sua.trong_luong, sua.don_gia, sua.hinh, sua.tp_dinh_duong, sua.loi_ich, hang_sua.ten_hang_sua 
        FROM sua 
        JOIN hang_sua ON sua.ma_hang_sua = hang_sua.ma_hang_sua 
        WHERE (sua.ten_sua LIKE '$search_term' OR '$ten_sua' = '') 
        AND (hang_sua.ten_hang_sua = '$hang_sua' OR '$hang_sua' = '') 
        AND (sua.ma_loai_sua = '$ma_loai_sua' OR '$ma_loai_sua' = '')";

$result = $conn->query($sql);
$tongsanpham = $result->num_rows;
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
            margin-top: 15px;
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
            margin: 10px 10px; 
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
                    <option value="<?= $row['ma_loai_sua']; ?>"><?= $row['ma_loai_sua']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="hang_sua">Hãng sữa:</label>
            <select name="hang_sua" id="hang_sua">
                <option value="">Tất cả</option>
                <?php while ($row = $hang_sua_result->fetch_assoc()): ?>
                    <option value="<?= $row['ten_hang_sua']; ?>"><?= $row['ten_hang_sua']; ?></option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="ten_sua">Tên sữa:</label>
            <input type="text" name="ten_sua" id="ten_sua" value="<?= htmlspecialchars($ten_sua); ?>">

            <button type="submit">Tìm kiếm</button>
        </form>
    </div>
    <h3 style="margin-bottom:-15px;padding:10px;text-align:center;background-color:moccasin">Có <?= $tongsanpham; ?> sản phẩm được tìm thấy</h3>

    <?php if ($tongsanpham > 0): ?>
        <table>
            <?php while ($dong = $result->fetch_assoc()): ?>
                <tr>
                    <td class="tieude2" colspan="2"><?= $dong['ten_sua']; ?> - <?= $dong['ten_hang_sua']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <img src="<?= $dong['hinh']; ?>" alt="<?= $dong['ten_sua']; ?>" class="product-image">
                    </td>
                    <td>
                        <p><strong><em>Thành phần dinh dưỡng:</em></strong> <?= $dong['tp_dinh_duong']; ?></p>
                        <p><strong><em>Lợi ích:</em></strong> <?= $dong['loi_ich']; ?></p>
                        <p><strong><em>Trọng lượng:</em></strong> <?= $dong['trong_luong']; ?> g - 
                        <strong><em>Đơn giá:</em></strong> <?= number_format($dong['don_gia'], 0, ',', '.'); ?> VNĐ</p>
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
