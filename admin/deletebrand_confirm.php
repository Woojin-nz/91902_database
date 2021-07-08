<?php

if(isset($_SESSION['admin'])) {

    $brandID = $_REQUEST['brandID'];

    $deletebrandsql = "SELECT * FROM `Brand` WHERE `Brand_ID` =".$_REQUEST['brandID'];
    $deletebrandquery = mysqli_query($dbconnect, $deletebrandsql);
    $deletebrand_rs = mysqli_fetch_assoc($deletebrandquery);

    $brand_items_sql = "SELECT * FROM `Menu` WHERE `Brand_ID` = ".$_REQUEST['brandID'];
    $brand_items_query = mysqli_query($dbconnect, $brand_items_sql);
    $brand_items_rs = mysqli_fetch_assoc($brand_items_query);
    $brand_items_count = mysqli_num_rows($brand_items_query);
    ?>

<h2> Delete Brand - Confirm </h2>

<p>Do you really want to delete the following brand?<br />
<b><?php echo $deletebrand_rs['Brand']; ?> </p></b>

<div class="error">
        There are <?php echo $brand_items_count; ?> item(s) associated with <b><?php echo $deletebrand_rs['Brand'] ?></b> and those will also be removed the from the database
</div>

<p>
    <a href="index.php?page=../admin/deletebrand&brandID=<?php echo $_REQUEST['brandID'];?>">Yes, Delete it!</a><br />
    <a href="index.php?page=../admin/admin_panel">No, take me back</a>

</p>
<?php
    }

else {

    $login_error = "Please login to access this page";
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>