<?php

if(isset($_SESSION['admin'])) {

    $activityID = $_REQUEST['activityID'];

    $deletebrandsql = "SELECT * FROM `Activity` WHERE `Activity_ID` =".$_REQUEST['activityID'];
    $deletebrandquery = mysqli_query($dbconnect, $deletebrandsql);
    $deletebrand_rs = mysqli_fetch_assoc($deletebrandquery);

    $brand_items_sql = "SELECT * FROM `MET` WHERE `Activity_ID` = ".$_REQUEST['activityID'];
    $brand_items_query = mysqli_query($dbconnect, $brand_items_sql);
    $brand_items_rs = mysqli_fetch_assoc($brand_items_query);
    $brand_items_count = mysqli_num_rows($brand_items_query);
    ?>

<h2> Delete Activity Group - Confirm </h2>

<p>Do you really want to delete the following activity group?<br />
<b><?php echo $deletebrand_rs['Activity']; ?> </p></b>

<div class="error">
        There are <?php echo $brand_items_count; ?> item(s) associated with <b><?php echo $deletebrand_rs['Activity'] ?></b> and those will also be removed the from the database
</div>

<p>
    <a href="index.php?page=../admin/deleteactivitybrand&activityID=<?php echo $_REQUEST['activityID'];?>">Yes, Delete it!</a><br />
    <a href="index.php?page=../admin/admin_panel">No, take me back</a>

</p>
<?php
    }


else {

    $login_error = "Please login to access this page";
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>