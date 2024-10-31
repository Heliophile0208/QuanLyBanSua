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

$sql = "SELECT ma_hang_sua, ten_hang_sua, dia_chi, dien_thoai, email FROM hang_sua";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin các hãng sữa</title>
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
            color: #003366; 
            margin: 0;      
            text-align: center; 
        }
        table {
            width: 100%;
            border-collapse: separate; 
            border-spacing: 5px;       
            margin-top: 20px; 
        }
        table, th, td {
            border: 1px solid black; 
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .canh{
            text-align:center
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>THÔNG TIN CÁC HÃNG SỮA</h2>
        <table>
            <tr class="canh">
                <th>Mã Hãng</th>
                <th>Tên Hãng</th>
                <th>Địa Chỉ</th>
                <th>Điện Thoại</th>
                <th>Email</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["ma_hang_sua"] . "</td>
                            <td>" . $row["ten_hang_sua"] . "</td>
                            <td>" . $row["dia_chi"] . "</td>
                            <td>" . $row["dien_thoai"] . "</td>
                            <td>" . $row["email"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>