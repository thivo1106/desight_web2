<?php
function getall_category()
{
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_category");
    $stmt->execute();
    //PDO::FETCH_ASSOC hàng số trả về dữ liệu kiểu mảng
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}

function getall_product()
{
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_product");
    $stmt->execute();
    //PDO::FETCH_ASSOC hàng số trả về dữ liệu kiểu mảng
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $pr = $stmt->fetchAll();
    return $pr;
}

function deleteproduct($id)
{
    $conn = connectdb(); // ket noi csdl
    $sql = "DELETE FROM tbl_product WHERE id=" . $id;

    // use exec() because no results are returned
    $conn->exec($sql);
}

// add account

function insert_sanpham($id, $category_id, $title, $price, $color, $discount, $img, $description, $created_at, $updated_at)
{
    $conn = connectdb();
    $sql = "INSERT INTO tbl_product (id,category_id, title, price,color,discount,img,description,created_at,updated_at)
    VALUES ('" . $id . "','" . $category_id . "', '" . $title . "', '" . $price . "', '" . $color . "','" . $discount . "','" . $img . "','" . $description . "','" . $created_at . "','" . $updated_at . "')";
    // use exec() because no results are returned
    $conn->exec($sql);
}

function get_category_name($category_id)
{
    // Giả sử bạn đã có một hàm connectdb() để kết nối CSDL
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT name FROM tbl_category WHERE id = ?");
    $stmt->execute([$category_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['name'];
}



// lay thông tin 1 sp lên input
function getonesp($id)
{
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_product WHERE id=" . $id);
    $stmt->execute();
    //PDO::FETCH_ASSOC hàng số trả về dữ liệu kiểu mảng
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}

function updatesp($id, $category_id, $title, $price, $color, $discount, $img, $description, $created_at, $updated_at)
{
    $conn = connectdb();
    // Kiểm tra xem có hình ảnh mới được tải lên không
    if ($img == "") {
        // Nếu không có hình ảnh mới, không cập nhật đường dẫn hình ảnh
        $sql = "UPDATE tbl_product SET category_id='" . $category_id . "', 
        title='" . $title . "', price='" . $price . "', color='" . $color . "' , discount='" . $discount . "' 
        , description='" . $description . "' , created_at='" . $created_at . "' , updated_at='" . $updated_at . "'   WHERE id=" . $id;
    } else {
        // Nếu có hình ảnh mới, cập nhật đường dẫn hình ảnh
        $sql = "UPDATE tbl_product SET category_id='" . $category_id . "', 
        title='" . $title . "', price='" . $price . "', color='" . $color . "' , discount='" . $discount . "' , img='" . $img . "' 
        , description='" . $description . "' , created_at='" . $created_at . "' , updated_at='" . $updated_at . "'   WHERE id=" . $id;
    }
    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare($sql);

    // Thực thi câu truy vấn
    $stmt->execute();

}




// tim kiếm 

function search_product($title)
{
    $conn = connectdb();
    $sql = "SELECT * FROM tbl_product WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%$title%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>