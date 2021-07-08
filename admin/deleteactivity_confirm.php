<?php

if(isset($_SESSION['admin'])) {

    $ID = $_REQUEST['itemID'];

    $deleteactivity_sql = "SELECT * FROM `MET` WHERE `ID` = '$ID'";
    $deleteactivity_query = mysqli_query($dbconnect, $deleteactivity_sql);
    $deleteactivity_rs = mysqli_fetch_assoc($deleteactivity_query);
    ?>
    
<h2> Delete activity - Confirm </h2>

<p>Do you really want to delete the following activity?<br />
<i><?php echo $deleteactivity_rs['Description']; ?> </i></p>

<p>
    <a href="index.php?page=../admin/deleteactivity&itemID=<?php echo $_REQUEST['itemID'];?>">Yes, Delete it!</a><br />
    <a href="index.php?page=../admin/admin_panel">No, take me back</a>

</p>
<?php

}


else {

    $login_error = "Please login to access this page";
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>