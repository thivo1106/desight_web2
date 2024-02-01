<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="nd">
        <!--Phần nhập dữ liệu thêm,sửa,xóa-->
        <div class="nd_top">

            <form action="index.php?act=addproduct" method="post" enctype="multipart/form-data">
                <div class="input-group1">
                    <input type="hidden" name="id" id="id">
                </div>

                <div class="input_trai" style="display: flex;">
                    <div class="input-group1">
                        <span>Danh mục</span>
                        <input type="text" name="category_id" id="category_id">
                    </div>

                    <div class="input-group1">
                        <span>Tên sản phẩm</span>
                        <input type="text" name="title" id="title">
                    </div>

                    <div class="input-group1">
                        <span>Giá</span>
                        <input type="text" name="price" id="price">
                    </div>


                    <div class="input-group1">
                        <span>Giá chưa giảm</span>
                        <input type="text" name="discount" id="discount">
                    </div>



                </div>


                <div class="input-right" style="display: flex;">

                    <div class="input-group2">
                        <span>Màu sắc</span>
                        <input type="text" name="color" id="color">
                    </div>


                    <div class="input-group2">
                        <span>Mô tả</span>
                        <input type="text" name="description" id="description">
                    </div>

                    <div class="input-group2" style="margin-right: 25px;">
                        <span>Ngày tạo</span>
                        <input type="datetime-local" name="created_at" id="created_at">
                    </div>

                    <div class="input-group2">
                        <span>Ngày cập nhật</span>
                        <input type="datetime-local" name="updated_at" id="updated_at">
                    </div>


                    <input type="submit" name="Themmoi" id="Themmoi" value="Thêm mới" class="button">

                </div>

                <div class="input_bot">
                    <div class="input-group1">
                        <span>Hình ảnh</span>
                        <input type="file" name="img" id="img">
                    </div>
                </div>
            </form>

          
        </div>
        <div>
                <!--tim kiem -->
                <form method="post" action="index.php?act=searchpr" style="float:left;background-color: #FFE4C4;width:100%;">
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
                    <td style="width:50px; font-weight: bold">Danh mục</td>
                    <td style="width:150px; font-weight: bold">Tên sản phẩm</td>
                    <td style="width:100px; font-weight: bold">Giá</td>
                    <td style="width:50px; font-weight: bold">Màu sắc</td>
                    <td style="width:100px; font-weight: bold">Giá chưa giảm</td>
                    <td style="width:80px; font-weight: bold">Hình ảnh</td>
                    <td style="width:150px; font-weight: bold">Mô tả</td>
                    <td style="width:50px; font-weight: bold">Ngày tạo</td>
                    <td style="width:50px; font-weight: bold">Ngày cập nhât</td>
                    <td style="width:50px; font-weight: bold">Thao tác</td>

                </tr>



                <!--chức năng tìm kiếm-->
                <?php if (isset($search_results) && count($search_results) > 0) : ?>
                    <table>

                        <?php $i = 1; ?>
                        <?php foreach ($search_results as $product) : ?>
                            <tr>
                                <td ><?= $i++ ?></td>
                                <td><?= get_category_name($product['category_id']) ?></td>
                                <td><?= $product['title'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td><?= $product['color'] ?></td>
                                <td><?= $product['discount'] ?></td>
                                <td><img src="<?= $product['img'] ?>" alt="Product Image"></td> <!-- Thêm cột ảnh -->
                                <td><?= $product['description'] ?></td>
                                <td><?= $product['created_at'] ?></td>
                                <td><?= $product['updated_at'] ?></td>
                                <td> <a href="index.php?act=productGet&id=' . $product['id'] . '">Sửa</a>
                                    <a href="index.php?act=deleteproduct&id=' . $product['id'] . '">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else : ?>
                <?php endif; ?>
                <!-- kết thúc chức năng tìm kiếm -->


                <?php
                // var_dump($kq);
                if (isset($pr) && ($pr) > 0) {
                    $i = 1;
                    foreach ($pr as $product) {
                        echo '<tr>
                        <td>' . $i . '</td>
                        <td>' . get_category_name($product['category_id']) . '</td>
                        <td>' . $product['title'] . '</td>
                        <td>' . $product['price'] . '</td>
                        <td>' . $product['color'] . '</td>
                        <td>' . $product['discount'] . '</td>
                        <td><img src="' . $product['img'] . '" width="80px"></td>
                        <td>' . $product['description'] . '</td>
                        <td>' . $product['created_at'] . '</td>
                        <td>' . $product['updated_at'] . '</td>
                        <td> <a href="index.php?act=productGet&id=' . $product['id'] . '">Sửa</a>  
                            <a href="index.php?act=deleteproduct&id=' . $product['id'] . '">Xóa</a></td> 
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
        display: flex;
        border: 1px solid #000;
        border-radius: 5px;
        height: 280px;
        width: 100%;
        background-color: #FFE4C4;
    }


    .input-group1 {
        width: 200px;
        font-weight: bold;
        margin-left: 15px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .input-group2 {

        width: 200px;
        font-weight: bold;
        margin-left: 15px;
        margin-top: 10px;
        margin-bottom: 10px;
    }



    .nd_bot table td img {
        max-width: 80px;

        max-height: 100px;

        width: auto;

        height: auto;

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
        margin-top: 30px;
        margin-left: 50px;
        height: 40px;
        width: 150px;
    }


    .timkiem {
        height: 80px;
        width: 350px;
        float: left;
    }
</style>