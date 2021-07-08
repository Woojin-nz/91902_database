<?php

if(isset($_SESSION['admin'])) {

    $ID = $_REQUEST['itemID'];

    $deleteitem_sql = "SELECT * FROM `Menu` JOIN Item ON (`Item`.`Item_ID` = `Menu`.`Item_ID` )WHERE `ID`=".$_REQUEST['itemID'];
    $deleteitem_query = mysqli_query($dbconnect, $deleteitem_sql);
    $deleteitem_rs = mysqli_fetch_assoc($deleteitem_query);

    ?>

<h2> Delete item - Confirm </h2>

<p>Do you really want to delete the following item?<br />
<i><?php echo $deleteitem_rs['Item']; ?> </i></p>

<p>
    <a href="index.php?page=../admin/deleteitem&itemID=<?php echo $_REQUEST['itemID'];?>">Yes, Delete it!</a><br />
    <a href="index.php?page=../admin/admin_panel">No, take me back</a>

</p>
<?php

}

else {

    $login_error = "Please login to access this page";
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>