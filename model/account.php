<?php

function getall_dm()
{
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_role");
    $stmt->execute();
    //PDO::FETCH_ASSOC hàng số trả về dữ liệu kiểu mảng
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $ac = $stmt->fetchAll();
    return $ac;
}

function getall_account()
{
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_user");
    $stmt->execute();
    //PDO::FETCH_ASSOC hàng số trả về dữ liệu kiểu mảng
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $ac = $stmt->fetchAll();
    return $ac;
}


//delete account
function deleteaccount($id)
{
    $conn = connectdb(); // ket noi csdl
    $sql = "DELETE FROM tbl_user WHERE id=" . $id;

    // use exec() because no results are returned
    $conn->exec($sql);
}

// add account

function addaccount($id, $fullname, $email, $phone_number, $address, $password, $role_id, $created_at, $updated_at)
{
    $conn = connectdb();
    $sql = "INSERT INTO tbl_user (id,fullname,email,phone_number,address,password,role_id,created_at,updated_at)
    VALUES ('" . $id . "','" . $fullname . "','" . $email . "', '" . $phone_number . "', '" . $address . "','" . $password . "','" . $role_id . "','" . $created_at . "','" . $updated_at . "')";
    // use exec() because no results are returned
    $conn->exec($sql);
}


// lấy thông tin account
function getoneaccount($id)
{
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE id=" . $id);
    $stmt->execute();
    //PDO::FETCH_ASSOC hàng số trả về dữ liệu kiểu mảng
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    return $kq;
}


function updateaccount($id, $fullname, $email, $phone_number, $address, $password, $role_id, $created_at, $updated_at)
{
    $conn = connectdb();
    $sql = "UPDATE tbl_user SET fullname='" . $fullname . "', email='" . $email . "', phone_number='" . $phone_number . "' 
    , address='" . $address . "', password='" . $password . "', role_id='" . $role_id . "', created_at='" . $created_at . "'
    , updated_at='" . $updated_at . "' WHERE id=" . $id;

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();
}

function get_role_text($role_id)
{
    switch ($role_id) {
        case 1:
            return "admin";
        case 2:
            return "nhân viên";
        case 3:
            return "khách";
        default:
            return "Unknown";
    }
}

// tim kiếm 

function search($fullname)
{
    $conn = connectdb();
    $sql = "SELECT * FROM tbl_user WHERE fullname LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%$fullname%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>