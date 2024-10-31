
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm Sữa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            margin: 0 auto;
            padding: 0;
            width: 700px;
            background-color: lightpink;
        }

        h2 {
            text-align: center;
            background-color: red;
            color: white;
            padding: 15px;
        }

        form {
            max-width: 700px;
            margin: 0 auto;
            padding: 0px 20px 20px 20px;
            background-color: lightpink;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            text-align: left;
        }

        label {
            display: inline-block;
            width: 150px;
            margin-right: 15px;
            vertical-align: top;
        }

        input[type="text"], input[type="number"], select, textarea {
            width: calc(100% - 300px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            display: inline-block;
        }

        input[type="file"] {
            padding: 8px;
        }

        input[type="submit"] {
            width: 150px;
            padding: 10px;
            text-align: center;
            background-color: white;
            border: 1px solid;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: darkred;
        }

        .nut {
            text-align: center;
        }
              .khung {
                   margin: 0px auto;
                   padding:0;
                   width: 700px; 
                   background-color: #ffffff;
                   border: 1px solid ; 
                   
               }
              
               .product-info {
                   display: flex;
                   border: 1px solid black; 
                   padding: 10px;
                   border-radius: 5px;
                   background-color: #f9f9f9;
                   margin-top: 20px;
               }
              
               .product-info img {
                   width: auto;
                   height: 197px;
                   border: 1px solid black;
                   margin-right: 20px;
               }
              
               .product-details {
                   flex-grow: 1;
                   padding: 10px;
                   color: purple;
                   border:1px solid;
                   height:177px
               }
              
               .product-details strong {
                   color: black;
               }
              
               .thongbao {
                   text-align: center;
                   font-size: 24px;
                   color: green;
                   margin-top: 20px;
               }
              
               .tieudemoi {
                   color: red;
                   font-weight: bold;
                   font-size: 24px;
                   background-color: #e6cea8;
                   padding: 10px;
                   border:1px solid;
                   width:680px;
                   margin-bottom:-20px;
              }

        .anh {
            display: flex;
            align-items: center;
        }

        .anh input[type="text"] {
            margin-left: 60px;
        }
        .thongbao{
            text-align:center;
            font-size:24px;
        }
        .tieudemoi{
            color:red;
            font-weight:bold;
            font-size:24px;
            background-color:#e6cea8;
            margin-top:-20px;
        }
    </style>
</head>
<body>
   <div class="container">
    <h2>THÊM SỮA MỚI</h2>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="ma_sua">Mã sữa:</label>
            <input type="text" id="ma_sua" name="ma_sua" required>
        </div>

        <div class="form-group">
            <label for="ten_sua">Tên sữa:</label>
            <input type="text" id="ten_sua" name="ten_sua" required>
        </div>

        <div class="form-group">
            <label for="hang_sua">Hãng sữa:</label>
            <select id="hang_sua" name="hang_sua">
                <?php
                $conn = new mysqli("localhost", "root", "", "ql_ban_sua");
                $sql = "SELECT ma_hang_sua, ten_hang_sua FROM hang_sua";
                $result = $conn->query($sql);
                mysqli_set_charset($conn,'utf8');
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['ma_hang_sua'] . "'>" . $row['ten_hang_sua'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="loai_sua">Loại sữa:</label>
            <select id="loai_sua" name="loai_sua">
                <?php
                $sql = "SELECT ma_loai_sua, ten_loai FROM loai_sua";
                $result = $conn->query($sql);
                mysqli_set_charset($conn,'utf8');
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['ma_loai_sua'] . "'>" . $row['ten_loai'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="trong_luong">Trọng lượng (gr):</label>
            <input type="number" id="trong_luong" name="trong_luong" required>
        </div>

        <div class="form-group">
            <label for="don_gia">Đơn giá (VNĐ):</label>
            <input type="number" id="don_gia" name="don_gia" required>
        </div>

        <div class="form-group">
            <label for="tp_dinh_duong">Thành phần dinh dưỡng:</label>
            <textarea id="tp_dinh_duong" name="tp_dinh_duong" required></textarea>
        </div>

        <div class="form-group">
            <label for="loi_ich">Lợi ích:</label>
            <textarea id="loi_ich" name="loi_ich" required></textarea>
        </div>

        <div class="form-group anh">
          <label for="hinh_url">Hình ảnh:</label>
          <input type="text" id="hinh_url" name="hinh_url" placeholder="Nhập URL hình ảnh">
          <input type="file" id="hinh" name="hinh">
        </div>

        <div class="nut">
           <input type="submit" value="THÊM MỚI">
        </div>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_sua = $_POST['ma_sua'];
    $ten_sua = $_POST['ten_sua'];
    $hang_sua = $_POST['hang_sua'];
    $loai_sua = $_POST['loai_sua'];
    $trong_luong = $_POST['trong_luong'];
    $don_gia = $_POST['don_gia'];
    $tp_dinh_duong = $_POST['tp_dinh_duong'];
    $loi_ich = $_POST['loi_ich'];
    $hinh_url = $_POST['hinh_url'];

  
    if (!empty($_FILES['hinh']['name'])) {
        // Tải ảnh từ máy
        $target_dir = "Image/";
        $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
        move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file);
        $hinh = $target_file;
    } elseif (!empty($hinh_url)) {
        // Nhập URL ảnh
        $hinh = $hinh_url;
    } else {
        $hinh = ""; // Không có ảnh
    }

   
    $sql = "INSERT INTO sua (ma_sua, ten_sua, ma_hang_sua, ma_loai_sua, trong_luong, don_gia, tp_dinh_duong, loi_ich, hinh)
            VALUES ('$ma_sua', '$ten_sua', '$hang_sua', '$loai_sua', $trong_luong, $don_gia, '$tp_dinh_duong', '$loi_ich', '$hinh')";

    if ($conn->query($sql) === TRUE) {
        echo'<div class="thongbao">';
        echo "<p>Thêm sữa mới thành công!</p>";
        echo '</div>';
    
        $sql = "SELECT sua.ten_sua, sua.trong_luong, sua.don_gia, sua.hinh, sua.tp_dinh_duong, sua.loi_ich, hang_sua.ten_hang_sua 
                FROM sua 
                INNER JOIN hang_sua ON sua.ma_hang_sua = hang_sua.ma_hang_sua 
                WHERE sua.ma_sua = '$ma_sua'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $dong = $result->fetch_assoc();

        
        echo '<div class="khung">';
        echo '<h2 class="tieudemoi">' . htmlspecialchars($dong['ten_sua']) . ' - ' . htmlspecialchars($dong['ten_hang_sua']) . '</h2>';
                    echo '<div class="product-info">';
                    echo '<div>';
                    echo '<img src="' . htmlspecialchars($dong['hinh']) . '" alt="' . htmlspecialchars($dong['ten_sua']) . '" style="width: auto; height: 197px; border: 1px solid black; margin-right: 20px;">';
                    echo '</div>';
                    echo '<div class="product-details">';
                    echo '<p><i><strong>Thành phần dinh dưỡng:</strong></i> ' . htmlspecialchars($dong['tp_dinh_duong']) . '</p>';
                    echo '<p><i><strong>Lợi ích:</strong></i> ' . htmlspecialchars($dong['loi_ich']) . '</p>';
                    echo '<p style="text-align:right; margin-top:100px; padding-right:5px"><strong>Trọng lượng:</strong> ' . htmlspecialchars($dong['trong_luong']) . 'g - <strong>Đơn giá:</strong> ' . number_format($dong['don_gia'], 0, ',', '.') . ' VNĐ</p><br>&nbsp';
                    echo '<p>&nbsp</p>';
                    echo '</div>'; 
                    echo '</div>'; 
                    echo '</div>'; 
                } else {
                    echo "<p style='color:red;'>Không tìm thấy sản phẩm.</p>";
                }
        
            } else {
                echo "<p style='color:red;'>Lỗi: " . htmlspecialchars($conn->error) . "</p>";
            }
        }
        
        // Đóng kết nối
        $conn->close();
        ?>
        </body>
        </html>