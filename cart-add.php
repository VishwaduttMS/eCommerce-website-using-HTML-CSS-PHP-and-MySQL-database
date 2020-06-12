<?php
require("common.php");
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO `user_item`(`user_id`, `item_id`, `status`) VALUES($user_id, $item_id, 1)";
    mysqli_query($con, $query)  or die(mysqli_error($con));
    header('location: products.php');
}
?>   