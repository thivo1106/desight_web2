<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">

    <style>
        .mainright-top {
            float: left;
            width: 100%;
            height: 20%;
            flex: 1;
            /* Phần trên sẽ mở rộng để chiếm hết khoảng trống còn lại */
            overflow-y: auto;
            /* Cho phép phần trên cuộn nếu nội dung vượt quá kích thước */
            background-color: #FFE4C4;
        }


        .mainright-mid {
            float: left;
            width: 100%;
            height: 90%;
            flex: 1;
            /* Phần trên sẽ mở rộng để chiếm hết khoảng trống còn lại */
            overflow-y: auto;
            /* Cho phép phần trên cuộn nếu nội dung vượt quá kích thước */

        }

        .mainright-bot {
            float: left;
            width: 100%;
            height: 10%;
            height: auto;
            /* Chiều cao tự động để phù hợp với nội dung */
            flex: 1;
            /* Phần trên sẽ mở rộng để chiếm hết khoảng trống còn lại */
            background-color: aliceblue;
        }
    </style>
</head>

<?php
include "../model/connectDB.php";
include "../model/account.php";
include "../model/product.php";


?>

<body>
    <div class="main">
        <!-- bên trái -->
        <div class="mainleft">
            <?php
            session_start();
            ob_start();
            //phần bên trái
            include "../viewadmin/danhmuc.php";
            ?>
        </div>

        <!-- bên phải-->

        <div class="mainright">
            <!-- phan 1-->
            <div class="mainright-top">
                <?php
                include "../viewadmin/header.php";
                ?>
            </div>

            <!-- phan 2-->
            <div class="mainright-mid">
                <?php


                // phần view giữa hien thi noi dung
                if (isset($_GET['act'])) {
                    switch ($_GET['act']) {
                            // phần account 
                        case 'account':
                            //get all role
                            $role = getall_dm();
                            //get all account
                            $ac = getall_account();
                            include "../viewadmin/account.php";
                            break;

                        case 'deleteac':
                            //get all role
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                deleteaccount($id);
                            }
                            $role = getall_dm();
                            //get all account
                            $ac = getall_account();
                            include "../viewadmin/account.php";
                            break;

                        case 'addac':
                            //get all role
                            if (isset($_POST['Themmoi']) && ($_POST['Themmoi'])) {
                                $id = $_POST['id'];
                                $fullname = $_POST['fullname'];
                                $email = $_POST['email'];
                                $phone_number = $_POST['phone_number'];
                                $address = $_POST['address'];
                                $password = $_POST['password'];
                                $role_id = $_POST['role_id'];
                                $created_at = $_POST['created_at'];
                                $updated_at = $_POST['updated_at'];
                                addaccount($id, $fullname, $email, $phone_number, $address, $password, $role_id, $created_at, $updated_at);
                            }
                            $role = getall_dm();
                            //get all account
                            $ac = getall_account();
                            include "../viewadmin/account.php";
                            break;

                            // lay tt account lên input
                        case 'infoupdate':
                            $role = getall_dm();

                            if (isset($_GET['id']) && ($_GET['id']) > 0) {
                                $id = $_GET['id'];
                                $stmt = getoneaccount($id);
                            }
                            $ac = getall_account();
                            include "../viewadmin/accountUpdate.php";
                            break;

                        case 'updateac':
                            if (isset($_POST['id'])) {
                                $id = $_POST['id'];
                                $fullname = $_POST['fullname'];
                                $email = $_POST['email'];
                                $phone_number = $_POST['phone_number'];
                                $address = $_POST['address'];
                                $password = $_POST['password'];
                                $role_id = $_POST['role_id'];
                                $created_at = $_POST['created_at'];
                                $updated_at = $_POST['updated_at'];
                                updateaccount($id, $fullname, $email, $phone_number, $address, $password, $role_id, $created_at, $updated_at);
                                $role = getall_dm();
                                //get all account
                                $ac = getall_account();
                                include "../viewadmin/account.php";
                            }

                            break;

                        case 'searchac':
                            if (isset($_POST['search'])) {
                                $search_keyword = $_POST['txtsearch'];
                                // Gọi hàm search để thực hiện tìm kiếm
                                $search_results = search($search_keyword);
                            } else {
                                echo "null!";
                            }
                            // Bao gồm tệp view để hiển thị kết quả
                            include "../viewadmin/account.php";
                            break;





                            /*product*/
                            // load ds
                        case 'product':
                            $kq = getall_category();
                            $pr = getall_product();
                            include "../viewadmin/product.php";
                            break;

                            // xoa sp
                        case 'deleteproduct':
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                deleteproduct($id);
                            }
                            $kq = getall_category();
                            $pr = getall_product();
                            include "../viewadmin/product.php";
                            break;

                            //them sp

                        case 'addproduct':

                            if (isset($_POST['Themmoi']) && ($_POST['Themmoi'])) {
                                $id = $_POST['id'];
                                $category_id = $_POST['category_id'];
                                $title = $_POST['title'];
                                $price = $_POST['price'];
                                $color = $_POST['color'];
                                $discount = $_POST['discount'];
                                $description = $_POST['description'];


                                //hinh anh = img
                                $target_dir = "uploads/";
                                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                                $img =  $target_file;
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                // Allow certain file formats
                                if (
                                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                                    && $imageFileType != "gif"
                                ) {
                                    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                    $uploadOk = 0;
                                }
                                if ($uploadOk == 1) {
                                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                                    $created_at = date("Y-m-d H:i:s");
                                    $updated_at = date("Y-m-d H:i:s");
                                    insert_sanpham($id, $category_id, $title, $price, $color, $discount, $img, $description, $created_at, $updated_at);
                                }
                            }
                            $kq = getall_category();
                            $pr = getall_product();
                            include "../viewadmin/product.php";
                            break;

                            // lấy thông tin sp lên input
                        case 'productGet':
                            $kq = getall_category();
                            //lay thong tin chi tiet sp
                            if ((isset($_GET['id']) && ($_GET['id']) > 0)) {
                                $spct = getonesp($_GET['id']);
                            }

                            $pr = getall_product();
                            include "../viewadmin/productUpdate.php";
                            break;

                            //cập nhật sản phẩm
                        case 'updatesp':
                            $kq = getall_category();
                            if ((isset($_POST['capnhat']) && ($_POST['capnhat']))) {
                                $id = $_POST['id'];
                                $category_id = $_POST['category_id'];
                                $title = $_POST['title'];
                                $price = $_POST['price'];
                                $color = $_POST['color'];
                                $discount = $_POST['discount'];
                                $description = $_POST['description'];
                                $created_at = date("Y-m-d H:i:s");
                                $updated_at = date("Y-m-d H:i:s");

                                // Kiểm tra xem có hình ảnh mới được tải lên không
                                if ($_FILES["img"]["name"] != "") {
                                    // Nếu có hình ảnh mới, di chuyển nó đến vị trí lưu trữ và cập nhật đường dẫn hình ảnh
                                    $target_dir = "uploads/";
                                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                                    $img = $target_file;
                                    $uploadOk = 1;
                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                    // Kiểm tra định dạng hình ảnh hợp lệ
                                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                        // Nếu không hợp lệ, không cập nhật hình ảnh
                                        $uploadOk = 0;
                                    }
                                    if ($uploadOk == 1) {
                                        // Di chuyển tệp hình ảnh vào vị trí lưu trữ
                                        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                                        // Cập nhật đường dẫn hình ảnh mới trong cơ sở dữ liệu
                                        // Cập nhật thông tin sản phẩm, bao gồm đường dẫn hình ảnh
                                        updatesp($id, $category_id, $title, $price, $color, $discount, $img, $description, $created_at, $updated_at);
                                    }
                                } else {
                                    // Nếu không có hình ảnh mới, tiếp tục sử dụng đường dẫn hình ảnh cũ
                                    $img = "";
                                    // Cập nhật thông tin sản phẩm, không cần cập nhật đường dẫn hình ảnh
                                    updatesp($id, $category_id, $title, $price, $color, $discount, $img, $description, $created_at, $updated_at);
                                }
                            }
                            $pr = getall_product();
                            include "../viewadmin/product.php";
                            break;

                                // tim kiếm sp trong list
                        case 'searchpr':
                            if (isset($_POST['search'])) {
                                $search_keyword = $_POST['txtsearch'];
                                // Gọi hàm search để thực hiện tìm kiếm
                                $search_results = search_product($search_keyword);
                            } else {
                                echo "null!";
                            }
                            // Bao gồm tệp view để hiển thị kết quả
                            include "../viewadmin/product.php";
                            break;




                        case 'statistical':
                            include "../viewadmin/statistical.php";
                            break;

                        case 'bill':

                            include "../viewadmin/bill.php";
                            break;


                        default:
                            include "../viewadmin/account.php";
                            break;
                    }
                } else {
                    include "../viewadmin/home.php";
                }


                ?>
            </div>


            <!-- phan 3-->
            <div class="mainright-bot">
                <?php
                include "../viewadmin/footer.php";
                ?>
            </div>

        </div>

    </div>
</body>

</html>