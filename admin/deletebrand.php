<?php

if(isset($_SESSION['admin'])) {

    $brand = $_REQUEST['brandID'];

    // Delete Items Associated
    $deleteitem_sql = "DELETE FROM `Menu` WHERE `Brand_ID` =".$_REQUEST['brandID'];
    $deleteitem_query = mysqli_query($dbconnect,$deleteitem_sql);

    //Delete the Brand
    $deletebrand_sql = "DELETE FROM `Brand` WHERE `Brand`.`Brand_ID`=".$_REQUEST['brandID'];
    $deletebrand_query = mysqli_query($dbconnect, $deletebrand_sql);
?>
<h1> Delete Success! </h1>

<p>The brand and its associated entries have been successfully deleted </p>


<?php
}

else {

    $login_error = "Please login to access this page";
    header("Location: index.php?page=../admin/login&error=$login_error");
}

?>