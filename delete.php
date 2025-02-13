<?php
include "config.php";
include "Database.php";

$db = new Database();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $query = "DELETE FROM tbl_user WHERE id = $id";
    if ($db->delete($query)) {
        header("Location: index.php?msg=User Deleted Successfully");
        exit();
    } else {
        echo "Failed to delete user!";
    }
} else {
    echo "Invalid ID!";
}
?>
