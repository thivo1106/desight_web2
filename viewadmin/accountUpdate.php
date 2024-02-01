<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="nd">
        <!--Phần nhập dữ liệu thêm,sửa,xóa-->


        <div class="nd_top">
            <form action="index.php?act=updateac" method="post">
        
                    <div class="input-group1">
                        <input type="hidden" name="id" id="id" value="<?= $stmt[0]['id'] ?>">
                    </div>

                    <div class="input-group1">
                        <span>Họ tên</span>
                        <input type="text" name="fullname" id="fullname" value="<?= $stmt[0]['fullname'] ?>">
                    </div>

                    <div class="input-group1">
                        <span>Email</span>
                        <input type="text" name="email" id="email" value="<?= $stmt[0]['email'] ?>">
                    </div>

                    <div class="input-group1">
                        <span>Số điện thoại</span>
                        <input type="text" name="phone_number" id="phone_number" value="<?= $stmt[0]['phone_number'] ?>">
                    </div>

                    <div class="input-group1">
                        <span>Địa chỉ</span>
                        <input type="text" name="address" id="address" value="<?= $stmt[0]['address'] ?>">
                    </div>

                    <div class="input-group1">
                        <span>Mật khẩu</span>
                        <input type="text" name="password" id="password" value="<?= $stmt[0]['password'] ?>">
                    </div>

                    <div class="input-group1">
                        <span>Quyền</span>
                        <input type="text" name="role_id" id="role_id" value="<?= $stmt[0]['role_id'] ?>">
                    </div>

                    <div class="input-group1" style="margin-right:30px ">
                        <span>Ngày tạo</span>
                        <input type="datetime-local" name="created_at" id="created_at" value="<?= $stmt[0]['created_at'] ?>">
                    </div>

                    <div class="input-group1">
                        <span>Ngày cập nhật</span>
                        <input type="datetime-local" name="updated_at" id="updated_at" value="<?= $stmt[0]['updated_at'] ?>">
                    </div>
            
                    <input type="submit" name="capnhat" id="capnhat" value="Cập nhật" class="button">
               
            </form>
        </div>



        <!--Phần hiển thị dữ liệu-->
        <div class="nd_bot">
            <table>
                <tr>
                    <td style="width:10px; font-weight: bold">stt</td>
                    <td style="width:100px; font-weight: bold">Họ tên</td>
                    <td style="width:150px; font-weight: bold">email</td>
                    <td style="width:50px; font-weight: bold">SDT</td>
                    <td style="width:200px; font-weight: bold">Địa chỉ</td>
                    <td style="width:100px; font-weight: bold">Mật khẩu </td>
                    <td style="width:50px; font-weight: bold">Quyền</td>
                    <td style="width:200px; font-weight: bold">Ngày tạo</td>
                    <td style="width:200px; font-weight: bold">Ngày cập nhât</td>
                    <td style="width:50px; font-weight: bold">Thao tác</td>

                </tr>
                <?php
                // var_dump($kq);
                if (isset($ac) && ($ac) > 0) {
                    $i = 1;
                    foreach ($ac as $account) {
                        echo '<tr>
                        <td>' . $i . '</td>
                        <td>' . $account['fullname'] . '</td>
                        <td>' . $account['email'] . '</td>
                        <td>' . $account['phone_number'] . '</td>
                        <td>' . $account['address'] . '</td>
                        <td>' . $account['password'] . '</td>
                        <td>' . $account['role_id'] . '</td>
                        <td>' . $account['created_at'] . '</td>
                        <td>' . $account['updated_at'] . '</td>
                        <td> <a href="index.php?act=infoupdate&id=' . $account['id'] . '">Sửa</a>  
                             <a href="index.php?act=deleteac&id=' . $account['id'] . '">Xóa</a></td> 
                        </tr>';
                        $i++;
                    }
                }
                ?>
            </table>
        </div>

    </div>

</html>

<style>
    /* css trang account*/
    .nd {
        width: 100%;
        height: 650px;
        background-color: white;
    }

    .nd_top {
        border: 1px solid #000;
        border-radius: 5px;
        height: 150px;
        width: 100%;
        background-color: #FFE4C4;
    }


    .input-group1 {
        width: 200px;
        float: left;
        font-weight: bold;
      
        margin-left: 5px;
        
    }


    
    .button {
        margin-top: 25px;
        margin-right: 100px;
    }

    /* CSS cho table */
    .nd_bot table {
        color: black;
        overflow-x: auto;
        /* Tạo thanh cuộn ngang */
        border: 1px solid #ddd;
        /* Đường viền bao ngoài cho table */
        width: 100%;
        border-collapse: collapse;
        /* Gộp các đường biên của ô lại với nhau */
    }

    /* CSS cho các hàng trong table */
    .nd_bot table tr {
        border-bottom: 1px solid #ddd;
        /* Đường viền dưới cho mỗi hàng */
    }

    /* CSS cho các ô trong table */
    .nd_bot table td {
        padding: 8px;
        /* Khoảng cách bên trong của mỗi ô */
        text-align: left;
        /* Căn chỉnh văn bản sang trái */
    }

    /* CSS cho ô đầu tiên của mỗi hàng */
    .nd_bot table tr td:first-child {
        width: 10px;
    }

    /* CSS cho ô còn lại */
    .nd_bot table tr td:not(:first-child) {
        width: 150px;
        border-left: 1px solid #ddd;
        /* Đường kẻ của cột */
    }


    .nd_bot table td a {
        display: block;
        margin: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s ease;
        text-align: center;
        background-color: #FFEFD5;
        font-weight: bold;
        color: black;
        /* Giữ màu chữ là đen */
    }

    .nd_bot table td a:hover {
        background-color: #f0f0f0;
        color: black;
        /* Đảm bảo màu chữ không thay đổi khi hover */
    }



</style>