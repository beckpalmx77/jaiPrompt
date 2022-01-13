<?php
session_start();
error_reporting(0);

include('../config/connect_db.php');
include('../config/lang.php');
include('../util/reorder_record.php');

if ($_POST["action"] === 'UPDATE_IMAGE') {



    $filename = $_FILES['file']['name'];
    /* Choose where to save the uploaded file */
    $location = "../gallery/" . $filename;
    /* Save the uploaded file to the local filesystem */

    $my_file = fopen("Init_Image.txt", "w") or die("Unable to open file!");
    fwrite($my_file, $filename . " | " . $location);
    fclose($my_file);


    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
        $table_name = $_POST["table_name"];
        $id = $_POST["id"];
        $img = $_POST["img_array"];


        $sql_find = "SELECT * FROM " . $table_name . " WHERE id = " . $id;

        $txt = $filename . " | ". $table_name . " | " .  $id . " | " . $img . " | " . $img . " | " . $sql_find;

        $my_file = fopen("Image.txt", "w") or die("Unable to open file!");
        fwrite($my_file, $txt);
        fclose($my_file);

        $nRows = $conn->query($sql_find)->fetchColumn();
        if ($nRows > 0) {
            $sql_update = "UPDATE " . $table_name . " SET img=:img WHERE id = :id";
            $query = $conn->prepare($sql_update);
            $query->bindParam(':img', $img, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            echo $save_success;
        }
    }
}