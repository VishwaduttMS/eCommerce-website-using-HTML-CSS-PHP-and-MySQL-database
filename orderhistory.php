<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Order History | Life Style Store</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid" id="content">
            <?php include 'includes/header.php'; ?>
            <div class="col-lg-4 col-md-6 ">
                    <img src="img/cart.jpg" style="float: left;">
                </div>
            <div class="row decor_bg">
                <div class="col-md-6">
                    <table class="table table-striped">
    
                        <!--show table only if there are items added in the cart-->
                        <?php
                        $sum = 0;$id='';
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT items.price AS Price, items.id As id, items.name AS Name  FROM user_item JOIN items ON user_item.item_id = items.id WHERE user_item.user_id='$user_id' and `status`=2";
                        $query1="SELECT user_item.date_time AS Timedate from user_item WHERE user_id='$user_id' and `status`=2";
                        $result = mysqli_query($con, $query)or die($mysqli_error($con));
                        $result1 = mysqli_query($con, $query1)or die($mysqli_error($con));
                        if (mysqli_num_rows($result) >= 1) {
                            ?>
                            <h1 style="margin-bottom: 20px; font-weight: 20;"><center>Order History</center></h1>
                            <thead>
                                <tr>
                                    <th>Item name</th>
                                    <th>Price</th>
                                    <th>Order & time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $id .= $row["id"] . ", ";
                                    echo '<tr><td><a href="order.php">'. $row["Name"] . "</a></td><td>Rs. " . $row["Price"] . "</td>";
                                    $total= $total + $row["Price"];
                                    while ($row1 = mysqli_fetch_array($result1) ) {
                                    echo"<td>" . $row1["Timedate"] . "</td></tr>"; 
                                    break;
                                }
                                }
                                echo "<tr><td>Total</td>"."<td>Rs. ".$total."</td></tr>";
                                ?>
                            </tbody>
                            <?php
                        } else {
                            echo "Sorry! No orders placed yet";
                        }
                        ?>
                        <?php
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </body>
</html>