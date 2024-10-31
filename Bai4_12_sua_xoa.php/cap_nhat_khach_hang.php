<?php
$servername = "127.0.0.1";  
$username = "root";         
$password = "";             
$dbname = "ql_ban_sua";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['ma_khach_hang'])) {
    $ma_kh = $_GET['ma_khach_hang'];
} else {
    die("Không tìm thấy mã khách hàng");
}

$sql = "SELECT * FROM khach_hang WHERE ma_khach_hang='$ma_kh'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Không tìm thấy khách hàng với mã: " . $ma_kh);
}

// Biến để lưu thông báo
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_kh = $_POST['ten_khach_hang'];
    $phai = $_POST['phai'];
    $dia_chi = $_POST['dia_chi'];
    $dien_thoai = $_POST['dien_thoai'];
    $email = $_POST['email'];

    if (!empty($ten_kh) && !empty($dia_chi) && !empty($dien_thoai) && !empty($email)) {
        // Cập nhật thông tin khách hàng
        $sql_update = "UPDATE khach_hang SET ten_khach_hang='$ten_kh', phai='$phai', dia_chi='$dia_chi', dien_thoai='$dien_thoai', email='$email' WHERE ma_khach_hang='$ma_kh'";
        if ($conn->query($sql_update) === TRUE) {
            $message = "Cập nhật thành công!";
        } else {
            $message = "Lỗi: " . $conn->error;
        }
    } else {
        $message = "Kiểm tra lại thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Thông Tin Khách Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            width: 600px;
            margin: 0 auto;
            padding: 0;
        }
        h2 {
            text-align: center;
            background-color: orange;
            color: #8B4513; 
            padding: 15px;
            margin: 0;
            width: 600px;
        }
        form {
            width: 600px;
            margin: 0 auto;
            background-color: #FFF8DC; 
            padding: 20px;
        }
        label {
            width: 150px;
            font-weight: bold;
            text-align: left;
            margin-right: 10px;
            display: inline-block;
        }
        input[type="text"], input[type="email"] {
            width: 400px; 
            padding: 8px;
            border: 1px solid;
            margin-right: 10px; 
        }
        .form-row {
            margin-bottom: 10px;
            display: flex;
            align-items: center; 
        }
        .action-row {
            background-color: #FAEBD7;
            text-align: center;
            margin-top: 20px;
            margin-left: -20px;
            margin-right: -20px;
            padding: 10px;
            margin-bottom: -25px;
        }
        input[type="submit"] {
            background-color: #ffffff; 
            color: #000000; 
            padding: 10px 20px;
            border: 2px solid #000000;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #f0f0f0;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #000;
        }
        .message {
            background-color: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            border-radius: 5px; 
            width:620px;
        }
    </style>
</head>
<body>
    <h2>CẬP NHẬT THÔNG TIN KHÁCH HÀNG</h2>
    <div class="container">
        <form method="POST">
            <div class="form-row">
                <label>Mã khách hàng: </label>
                <span style="border:1px solid; padding:5px; width:200px;background-color:white;"><?php echo $row['ma_khach_hang']; ?></span>
            </div>
            <div class="form-row">
                <label>Tên khách hàng: </label>
                <input type="text" name="ten_khach_hang" value="<?php echo $row['ten_khach_hang']; ?>">
            </div>
            <div class="form-row">
                <label>Giới tính: </label>
                <input type="radio" name="phai" value="0" <?php if ($row['phai'] == 0) echo 'checked'; ?>>Nam
                <input type="radio" name="phai" value="1" <?php if ($row['phai'] == 1) echo 'checked'; ?>>Nữ
            </div>
            <div class="form-row">
                <label>Địa chỉ: </label>
                <input type="text" name="dia_chi" value="<?php echo $row['dia_chi']; ?>">
            </div>
            <div class="form-row">
                <label>Điện thoại: </label>
                <input type="text" name="dien_thoai" value="<?php echo $row['dien_thoai']; ?>">
            </div>
            <div class="form-row">
                <label>Email: </label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="action-row">
                <input type="submit" value="Cập nhật">
            </div>
        </form>
   
   </div> 
        <!-- Hiển thị thông báo nếu có -->
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <div style="text-align: center">
                 <a href="thong_tin_khach_hang.php">Quay lại danh sách</a>
       </div>
    <?php
    $conn->close();
    ?>
</body>
</html>