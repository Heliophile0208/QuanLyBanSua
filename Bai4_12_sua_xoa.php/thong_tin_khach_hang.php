
<?php
$servername = "127.0.0.1";  
$username = "root";         
$password = "";             
$dbname = "ql_ban_sua";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
mysqli_set_charset($conn ,"utf8");

$sql = "SELECT ma_khach_hang, ten_khach_hang, phai, dia_chi, dien_thoai FROM khach_hang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
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
            color: black; 
            margin: 0;      
            text-align: center; 
            text-transform: uppercase; 
        }
        table {
            width: 100%;
            border-collapse: separate; 
            border-spacing: 0;       
            margin-top: 20px; 
        }
        table, th, td {
            border: 1px solid black; 
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; 
        }
        tr:nth-child(even) td {
            background-color: #FFA500; 
        }
        td:nth-child(odd) {
            background-color: #ffffff; 
        }
        .gioi-tinh {
            text-align: center; 
        }
        .actions {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông Tin Khách Hàng</h2>
        <table>
            <tr>
                <th>STT</th>
                <th>Mã Khách Hàng</th>
                <th>Tên Khách Hàng</th>
                <th class="gioi-tinh">Giới Tính</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th class="actions">Sửa</th>
                <th class="actions">Xóa</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                $stt = 1; 
                while($row = $result->fetch_assoc()) {
                    $phai = $row["phai"] ? "Nam" : "Nữ"; 
                    echo "<tr>
                            <td>" . $stt++ . "</td>
                            <td>" . $row["ma_khach_hang"] . "</td>
                            <td>" . $row["ten_khach_hang"] . "</td>
                            <td class='gioi-tinh'>" . $phai . "</td>
                            <td>" . $row["dia_chi"] . "</td>
                            <td>" . $row["dien_thoai"] . "</td>
                            <td class='actions'>
                                <a href='cap_nhat_khach_hang.php?ma_khach_hang=" . $row["ma_khach_hang"] . "'>Sửa</a>
                            </td>
                            <td class='actions'>
                                <a href='xoa_khach_hang.php?ma_khach_hang=" . $row["ma_khach_hang"] . "'>Xóa</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>