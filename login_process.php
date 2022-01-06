<?php
session_start();
error_reporting(0);
include('config/connect_db.php');

if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$sql = "SELECT *,pm.dashboard_page as dashboard_page FROM ims_user  
        left join ims_permission pm on pm.permission_id = ims_user.account_type WHERE email=:username ";
$query = $conn->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() == 1) {
    foreach ($results as $result) {
        if (password_verify($_POST['password'], $result->password)) {
            $_SESSION['alogin'] = $result->email;
            $_SESSION['login_id'] = $result->id;
            $_SESSION['username'] = $result->email;
            $_SESSION['first_name'] = $result->first_name;
            $_SESSION['last_name'] = $result->last_name;
            $_SESSION['email'] = $result->email;
            $_SESSION['account_type'] = $result->account_type;
            $_SESSION['user_picture'] = $result->picture;
            $_SESSION['lang'] = $result->lang;
            $_SESSION['system_name'] = "Jai Prompt Enterprise Resource Planning";
            echo $result->dashboard_page . ".php";
        } else {
            echo 0;
        }
    }
}