<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="nd">
        <!--Phần nhập dữ liệu thêm,sửa,xóa-->
        <div class="nd_top">

            <form action="index.php?act=addac" method="post">
                <div class="input-group1">
                    <input type="hidden" name="id" id="id">
                </div>

                <div class="input-group1">
                    <span>Họ tên</span>
                    <input type="text" name="fullname" id="fullname">
                </div>

                <div class="input-group1">
                    <span>Email</span>
                    <input type="text" name="email" id="email">
                </div>

                <div class="input-group1">
                    <span>Số điện thoại</span>
                    <input type="text" name="phone_number" id="phone_number">
                </div>

                <div class="input-group1">
                    <span>Địa chỉ</span>
                    <input type="text" name="address" id="address">
                </div>

                <div class="input-group2">
                    <span>Mật khẩu</span>
                    <input type="text" name="password" id="password">
                </div>

                <div class="input-group2">
                    <span>Quyền</span>
                    <input type="text" name="role_id" id="role_id">
                </div>

                <div class="input-group2">
                    <span>Ngày tạo</span>
                    <input type="datetime-local" name="created_at" id="created_at">
                </div>

                <div class="input-group2">
                    <span>Ngày cập nhật</span>
                    <input type="datetime-local" name="updated_at" id="updated_at">
                </div>

                <input type="submit" name="Themmoi" id="Themmoi" value="Thêm mới" class="button">


            </form>

        <!--chức năng tìm kiếm-->
    
            <form method="post" action="index.php?act=searchac">
                <div class="input-group" style="width: 300px; height:40px;margin-left:10px;margin-bottom:5px;">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here.." name="txtsearch">
                    <input type="submit" value="Tìm kiếm" name="search" style="margin-left:10px;  border-radius: 10px;">
                </div>
            </form>

        <!--end search-->

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


                <!--chức năng tìm kiếm-->
                <?php if (isset($search_results) && count($search_results) > 0) : ?>
                    <table>
                        <?php $i = 1; ?>
                        <?php foreach ($search_results as $account) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $account['fullname'] ?></td>
                                <td><?= $account['email'] ?></td>
                                <td><?= $account['phone_number'] ?></td>
                                <td><?= $account['address'] ?></td>
                                <td><?= $account['password'] ?></td>
                                <td><?= get_role_text($account['role_id']) ?></td>
                                <td><?= $account['created_at'] ?></td>
                                <td><?= $account['updated_at'] ?></td>
                                <td>
                                    <a href="index.php?act=infoupdate&id=<?= $account['id'] ?>">Sửa</a>
                                    <a href="index.php?act=deleteac&id=<?= $account['id'] ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else : ?>
                <?php endif; ?>
                <!-- kết thúc chức năng tìm kiếm -->





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
                        <td>' . get_role_text($account['role_id']) . '</td>
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
        height: 200px;
        width: 100%;
        background-color: #FFE4C4;
    }


    .input-group1 {
        width: auto;
        float: left;
        font-weight: bold;
        margin-left: 20px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .input-group2 {
        width: auto;
        float: left;
        font-weight: bold;
        margin-left: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
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



    .button {
        margin-top: 25px;
    }
</style>