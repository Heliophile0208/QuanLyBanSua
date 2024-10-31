<?php
$servername = "127.0.0.1";  
$username = "root";         
$password = "";             
$dbname = "ql_ban_sua";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy mã khách hàng từ URL
if (isset($_GET['ma_khach_hang'])) {
    $ma_kh = $_GET['ma_khach_hang'];
} else {
    die("Không tìm thấy mã khách hàng");
}

// Lấy thông tin khách hàng từ CSDL
$sql = "SELECT * FROM khach_hang WHERE ma_khach_hang='$ma_kh'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Không tìm thấy khách hàng với mã: " . $ma_kh);
}

// Kiểm tra xem khách hàng đã mua hàng hay chưa
$sql_check_purchase = "SELECT COUNT(*) as count FROM hoa_don WHERE ma_khach_hang='$ma_kh'";
$result_check = $conn->query($sql_check_purchase);
$purchase_count = $result_check->fetch_assoc()['count'];

// Xử lý xóa khách hàng
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($purchase_count == 0) {
        // Xóa khách hàng
        $sql_delete = "DELETE FROM khach_hang WHERE ma_khach_hang='$ma_kh'";
        if ($conn->query($sql_delete) === TRUE) {
            $message = "Khách hàng đã được xóa thành công!";
        } else {
            $message = "Lỗi: " . $conn->error;
        }
    } else {
        $message = "Khách hàng " . $row['ten_khach_hang'] . " đã mua hàng nên không thể xóa được.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Khách Hàng</title>
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
        .container {
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
            width:600px;
            border: 1px solid #c3e6cb; 
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            border-radius: 5px;
        }
     
    </style>
</head>
<body>
    <h2>XÓA KHÁCH HÀNG</h2>
    <div class="container">
        <form method="POST">
            <div class="form-row">
                <label>Mã khách hàng: </label>
                <span style="border:1px solid; padding:5px; width:400px;background-color:white; "><?php echo $row['ma_khach_hang']; ?></span>
            </div>
            <div class="form-row">
                <label>Tên khách hàng: </label>
                <span style="border:1px solid; padding:5px; width:400px;background-color:white;"><?php echo $row['ten_khach_hang']; ?></span>
            </div>
            <div class="form-row">
                <label>Địa chỉ: </label>
                <span style="border:1px solid; padding:5px; width:400px;background-color:white;"><?php echo $row['dia_chi']; ?></span>
            </div>
            <div class="form-row">
                <label>Điện thoại: </label>
                <span style="border:1px solid; padding:5px; width:400px;background-color:white;"><?php echo $row['dien_thoai']; ?></span>
            </div>
            <div class="form-row">
                <label>Email: </label>
                <span style="border:1px solid; padding:5px; width:400px;background-color:white;"><?php echo $row['email']; ?></span>
            </div>
            <div class="action-row">
                <input type="submit" value="Xóa khách hàng" style=" padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            </div>
        </form>
</div>
        <!-- Hiển thị thông báo nếu có -->
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <div style="text-align: center;">
            <a href="thong_tin_khach_hang.php">Quay lại danh sách</a>
        </div>
    
    <?php
    $conn->close();
    ?>
</body>
</html>